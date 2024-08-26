<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function createAccount(Request $request)
{
    // التحقق من صحة البيانات المرسلة
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
        'phone' => 'required',
        'role_id' => 'required',
    ]);

    try {
        // إنشاء مستخدم جديد
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'role_id' => $validatedData['role_id'],
        ]);

        return response()->json([
            'message' => 'تم التسجيل بنجاح!',
            'user' => $user,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'حدث خطأ أثناء عملية التسجيل',
            'error' => $e->getMessage(),
        ], 500);
        
    }
    
}
    
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response([
                'message' => 'Invalid login attempt'
            ], 401);
        }
    
        // إذا كان هناك طلب إعادة تعيين كلمة المرور، قم بتحديث كلمة المرور
        if ($request->has('reset_password') && $request->reset_password == true) {
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            // التحقق من كلمة المرور إذا لم يتم إعادة تعيينها
            if (!Hash::check($request->password, $user->password)) {
                return response([
                    'message' => 'Invalid login attempt'
                ], 401);
            }

        }
              /* @var User $user */
        
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ],201);
     
    }
    // public function logout(Request $request){

    //     auth()->user()->tokens()->delete();
    //     return [
    //         'message' => 'has Logout'
    //     ];
    // }
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            
            return response()->json([
                'message' => 'Logout successful'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to logout',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function forgetPassword(Request $request){
    //     try{
    //     $user=User::where('email',$request->email)->get();

    //     if(count($user)>0){
    //     $token=Str::random(40);
    //     $domain=URL::to('/');
    //     $url=$domain.'/reset-password?token'.$token;

    //     $data['url']=$url;
    //     $data['email']=$request->email;
    //     $data['title']="Reset Password";
    //     $data['body']="Please click on below link to reset your password";
    //     }
    //     else{
    //         return response()->json(['success'=>false,'msg'=>"User not found"]);

    //     }
    //     }catch(\Exception $e){
    //         return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
    //     }
    // }
}

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// use App\Models\User;

// class UsersController extends Controller
// {
//     public function createAccount(Request $request)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//             'phone' => 'required',
//             'role_id' => 'required',
//         ]);

//         try {
//             $user = User::create([
//                 'name' => $validatedData['name'],
//                 'email' => $validatedData['email'],
//                 'password' => Hash::make($validatedData['password']),
//                 'phone' => $validatedData['phone'],
//                 'role_id' => $validatedData['role_id'],
//             ]);

//             $token = $user->createToken('authToken')->plainTextToken;

//             return response()->json([
//                 'message' => 'تم التسجيل بنجاح!',
//                 'user' => $user,
//                 'token' => $token,
//             ], 201);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'message' => 'حدث خطأ أثناء عملية التسجيل',
//                 'error' => $e->getMessage(),
//             ], 500);
//         }
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|string|email',
//             'password' => 'required|string',
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return response()->json(['message' => 'Invalid login attempt'], 401);
//         }

//         $token = $user->createToken('authToken')->plainTextToken;

//         return response()->json([
//             'user' => $user,
//             'token' => $token,
//         ], 201);
//     }

//     public function logout(Request $request)
//     {
//                try {
//             $request->user()->tokens()->delete();
            
//             return response()->json([
//                 'message' => 'Logout successful'
//             ], 200);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'error' => 'Failed to logout',
//                 'message' => $e->getMessage(),
//             ], 500);
//         }
//     }
// }
