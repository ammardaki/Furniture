<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use App\Http\Requests\Auth\ResetRequest;
// use App\Notifications\ResetPasswordVerificationNotification;
// use Otp;
// use Hash;

// class ControllerReset extends Controller
// {
//     private $otp;

//     public function __construct()
//     {
//         $this->otp = new Otp;
//     }

//     public function resetpass(ResetRequest $request)
//     {
//         // التحقق من وجود الـ OTP قبل الاستمرار
//         if (!$request->otp) {
//             return response()->json(['error' => 'OTP is required'], 400);
//         }
    
//         $otp2 = $this->otp->validate($request->email, $request->otp);
    
//         if (!$otp2->status) {
//             return response()->json(['error' => $otp2], 401);
//         }
    
//         $user = User::where('email', $request->email)->first();
    
//         if (!$user) {
//             return response()->json(['error' => 'User not found'], 404);
//         }
    
//         // تحديث كلمة المرور إلى القيمة الجديدة بعد التحقق من الـ OTP
//         $user->where('email', $request->email)->update(['password' => Hash::make($request->password)]);
    
//         // حذف جميع الـ tokens المرتبطة بالمستخدم
//         $user->tokens()->delete();
    
//         $success['success'] = true;
//         return response()->json($success, 200);
//     }
// }    

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\ResetRequest;
use App\Notifications\ResetPasswordVerificationNotification;
use Otp;
use Hash;

class ControllerReset extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function resetpass(ResetRequest $request)
    {
        // التحقق من وجود الـ OTP قبل الاستمرار
        if (!$request->otp) {
            return response()->json(['error' => 'OTP is required'], 400);
        }
    
        $otp2 = $this->otp->validate($request->email, $request->otp);
    
        if (!$otp2->status) {
            return response()->json(['error' => $otp2], 401);
        }
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // حذف كلمة المرور القديمة
        $user->password = Hash::make($request->password);
        $user->save();
        
        // $user->save();
        
    
        // حذف جميع الـ tokens المرتبطة بالمستخدم
        // $user->tokens()->delete();
    
        $success['success'] = true;
        return response()->json($success, 200);
    }
}
