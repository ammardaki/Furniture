<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle user authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if the user email is admin and password is adminadmin
        if ($user->email === 'admin@mail.com' && $request->password === 'adminadmin') {
            // Redirect to /homeadmin if admin login
            return redirect('/homeadmin');
        }

        // Redirect to /home for other users
        return redirect('/home');
    }
}
// namespace App\Http\Controllers\Auth;

// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Laravel\Sanctum\HasApiTokens;

// class LoginController extends Controller
// {
//     use AuthenticatesUsers, HasApiTokens;

//     protected $redirectTo = '/home';

//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }

//     /**
//      * Handle user authenticated
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  mixed  $user
//      * @return mixed
//      */
//     protected function authenticated(Request $request, $user)
//     {
//         // توليد التوكن للمستخدم
//         $token = $user->createToken('authToken')->plainTextToken;
//         // تخزين التوكن في الجلسة
//         session(['token' => $token]);

//         // التحقق مما إذا كان المستخدم إداري
//         if ($user->email === 'admin@mail.com' && $request->password === 'adminadmin') {
//             return redirect('/homeadmin');
//         }

//         return redirect('/home');
//     }
// }
