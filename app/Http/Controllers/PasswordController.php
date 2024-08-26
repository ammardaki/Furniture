<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\APIPasswordResetTokenModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password; // استيراد واجهة Password
use Illuminate\Validation\ValidationException; // استيراد استثناء الـ ValidationException
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Notifications\APIPasswordResetNotification;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
class PasswordController extends Controller
{

    public function forget(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return ['status' => __($status)];
        }

        // استخدام ValidationException من Illuminate\Validation\ValidationException
        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
    public function sendPasswordResetToken(Request $request)
    {
        $rules = [
            "email" => "required|email|exists:users,email",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->errorMessage(true, $validator->errors()->all());
        }
        $data = $validator->validated();

        $user = User::where("email", $data["email"])->first();
        if (!$user) {
            return $this->errorMessage(true, "User not found");
        }

        $token = $this->genResetCode();
        $signature = hash('md5', $token);
        do {
            $exists = APIPasswordResetTokenModel::where([
                ["user_id", $user->id],
                ["token_signature", $signature]
            ])->exists();
            if (!$exists) {
                break;
            }
            $token = $this->genResetCode();
            $signature = hash('md5', $token);
        } while ($exists);

        try {
            $user->notify(new APIPasswordResetNotification($token));
            APIPasswordResetTokenModel::create([
                "user_id" => $user->id,
                "token_signature" => $signature,
                "expires_at" => Carbon::now()->addMinutes(30),
            ]);
            return $this->errorMessage(false, "A password reset token has been sent to your email, please enter the password reset page to reset your password");
        } catch (\Throwable $th) {
            return $this->errorMessage(true, $th->getMessage());
        }
    }   public function validatePasswordResetToken($data)
    {
        $resetToken=APIPasswordResetTokenModel::where([
            ["token_signature",hash('md5',$data['password_reset_code'])],
            ["token_type",APIPasswordResetTokenModel::PASSWORD_RESET_TOKEN]
        ])->first();
        if($resetToken==null||$resetToken->count()<=0){
            $this->error_message="Invalid password reset code";
            return false;
        }
        if(Carbon::now()->greaterThan($resetToken->expires_at))
        {
            $this->error_message="The password reset code given has expired";
            return false;
        }
    $reset_token=$resetToken->getResetIdentifierCode();
    if($reset_token){
        $resetToken->update([
            "expires_at"=>Carbon::now(),
        ]);
        return [
            "token"=>$reset_token,
        ];

    }else{
        $this->error_message=$resetToken->getErrorMessage();
        return false;
    }
    }
    public function getResetIdentifierCode()
    {
        $token=$this->genResetCode();
        try{$this->create([
            "user_id"=> $this->user_id,
            "token_signature"=>hash("md5",$token),
            "used_token"=>$this->id,
            "token_type"=>APIPasswordResetTokenModel::PASSWORD_VERIF_TOKEN,
            "expires_at"=>Carbon::now()->addMinutes(30),
        ]);
        return $token;
    }catch(\Throwable $th){
     $this->error_message=$th->getMessage();
    }
}
public function setNewAccountPassword(Request $request)
{
    $rules = [
        "password_token" => "required|string|max:8",
        "password" => "required|confirmed|string|max:45",
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return $this->errorMessage(true, $validator->errors()->all());
    }

    $data = $validator->validated();

    $verifToken = APIPasswordResetTokenModel::where([
        ['token_signature', hash('md5', $data['password_token'])],
        ['token_type', APIPasswordResetTokenModel::PASSWORD_VERIF_TOKEN]
    ])->first();

    if (!$verifToken) {
        return $this->errorMessage(true, "Invalid token for resetting password");
    }

    $user = $verifToken->UserInfo;
    if (!$user) {
        return $this->errorMessage(true, "Token does not correspond to any existing user");
    } elseif (Carbon::now()->greaterThan($verifToken->expires_at)) {
        return $this->errorMessage(true, "The reset password token has expired");
    }

    $newPassword = Hash::make($data["password"]);
    $user->password = $newPassword;
    $user->save();

    $verifToken->update([
        "expires_at" => Carbon::now()
    ]);

    return $this->errorMessage(false, "success", ["user" => $user]);
}

    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'=>'required',
            'password'=>'required|min:6|max:100',
            'confirm_password'=>'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        }

        $user=$request->user();
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'Password successfully updated',
            ],200);
        }else{
            return response()->json([
                'message'=>'Old password does not matched',
            ],400);
        }

    }

}