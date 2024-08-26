<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ForgetRequest;
use App\Notifications\ResetPasswordVerificationNotification;
use Hash;



class ControllerForget extends Controller
{
    public function forgettpass(ForgetRequest $request)
    {
     $input=$request->only('email');
     $user=User::where('email',$input)->first();
     $user->notify(new ResetPasswordVerificationNotification());
     $success['success']=true;
     return response()->json($success,200);
    }
    // public function forgettpass(ForgetRequest $request)
    // {
    //     $input = $request->only('email');
    //     $user = User::where('email', $input)->first();
    //           $user->notify(new ResetPasswordVerificationNotification());

    //     // تحديث الكلمة السرية إلى كلمة مؤقتة أو أي قيمة محددة للإعادة التعيين
    //     // $user->password = Hash::make('temporary_password');
    //     // $user->save();
        
    //     $success['success'] = true;
    //     return response()->json($success, 200);
    // }
}
