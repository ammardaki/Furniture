<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\Auth\ControllerForget;
use App\Http\Controllers\Auth\ControllerReset;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// // Route::post('/user/register ' , 'UsersController@createAccount');

// Route::post('/login', [UsersController::class, 'login']);
// Route::post('/register', [UsersController::class, 'createAccount']);

// Route::group(['middleware' => ['auth:sanctum','checkAdmi']], function ()
//  {
// Route::get('/logout', [UsersController::class, 'logout']);});
// ///product managment....................
// Route::post('/furniture/store', [FurnitureController::class, 'store']);
// Route::delete('/furniture/destroy/{id}', [FurnitureController::class, 'destroy']);
// Route::get('/furniture/show/{id}', [FurnitureController::class, 'show']);
// Route::get('/furniture/getAll', [FurnitureController::class, 'getAll']);
// Route::post('/search', [FurnitureController::class, 'search']);
// Route::get('/furniture/edit/{id}',[FurnitureController::class ,'edit']);
// Route::post('/furniture/update/{id}',[FurnitureController::class ,'update']);
// ///comment.............................
// Route::post('/comment', [CommentController::class, 'store']);
// Route::get('/showComment', [CommentController::class, 'showComment']);
// ///reservation managment...............
// //Route::post('/reservation/store', [ReservationController::class, 'store']);
// //Route::delete('/reservation/destroy/{id}', [ReservationController::class, 'destroy']);

// Route::post('/reservation', [ReservationController::class, 'store'])
// ->name('reservation.store')->middleware('auth:sanctum');
// Route::prefix('api')->group(function () {
//     // Route::get('/reservations', [ReservationController::class,'index']);
//     Route:: post('/cancel',[ReservationController::class ,'cancel']);
//     ///evaluation..........................
//     Route::post('/evaluation', [EvaluationController::class, 'store']);
//     Route::get('/showEvaluation', [EvaluationController::class, 'showEvaluation']);
// });

// Route::get('f', [ReservationController::class,'index']);
// Route::get('/reservation/edit/{id}',[ReservationController::class ,'edit']);

// Route::post('/reservation/update/{id}',[ReservationController::class ,'update']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//ads4
Route::post('ads/storeads', [AdController::class, 'storeads']);

Route::post('password/forget_pass', [ControllerForget::class, 'forgettpass']);

// Route::post('/ads', 'AdController@store');
Route::middleware('auth:sanctum')->post('/ads', [AdController::class, 'storeads']); // إضافة إعلان جديد
Route::get('ads/index', [AdController::class, 'index']); // عرض كل الإعلانات
Route::get('ads/{id}/show', [AdController::class, 'show']); // عرض تفاصيل إعلان معين
//Route::middleware('auth:sanctum')->put('ads/{id}/update', [AdController::class, 'updateads']); // تحديث إعلان
Route::middleware('auth:sanctum')->group(function () {

    Route::put('/ads/{id}', [AdController::class, 'updateads']);
    Route::delete('/ads/{id}', [AdController::class, 'destroy']); // حذف إعلان

});
//ads

Route::post('forget', [PasswordController::class, 'forget']);
Route::post('reset-password', [PasswordController::class, 'reset']);
Route::prefix('/user')->group(function () {
    Route::post('/reset-password-token', [PasswordController::class, 'resetPassword'])->name('api-reset-password-token');
    Route::post('/forgot-password', [PasswordController::class, 'sendPasswordResetToken'])->name('api-reset-password');
    Route::post('/new-password', [PasswordController::class, 'sendNewAccountPassword'])->name('new-account-password');

});
Route::post('password/forget_pass', [ControllerForget::class, 'forgettpass']);
Route::post('password/reset_pass', [ControllerReset::class, 'resetpass']);

Route::post('/api/reset-password', [NewPasswordController::class, 'store']);
Route::post('/profile/change-password', [PasswordController::class, 'change_password'])->middleware('auth:sanctum');

// // image

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/user/register ' , 'UsersController@createAccount');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [UsersController::class, 'logout']);
});

/////////////////
Route::group(['middleware' => 'auth:sanctum', 'checkAdmin'], function () {
///product managmen....................
    Route::post('/furniture/store', [FurnitureController::class, 'store']);
    Route::delete('/furniture/destroy/{id}', [FurnitureController::class, 'destroy']);
    Route::post('/furniture/update/{id}', [FurnitureController::class, 'update']);
});

Route::post('/login', [UsersController::class, 'login']);
// Route::get('/furniture/getAll', [FurnitureController::class, 'getAll']);
Route::get('/furniture/getAll', [FurnitureController::class, 'getAll'])->name('furniture.getAll');

///product managmen....................

Route::get('/furniture/show/{id}', [FurnitureController::class, 'show']);
Route::post('/search', [FurnitureController::class, 'search']);
///comment.............................
Route::post('/comment', [CommentController::class, 'store']);
Route::get('/showComment', [CommentController::class, 'showComment']);
///evaluation..........................
Route::post('/evaluation', [EvaluationController::class, 'store']);
Route::get('/showEvaluation', [EvaluationController::class, 'showEvaluation']);

Route::post('/register', [UsersController::class, 'createAccount']);

Route::group(['middleware' => 'auth:sanctum', 'checkUser'], function () {
///reservation managment...............
    Route::delete('/reservation/destroy/{id}', [ReservationController::class, 'destroy']);
    Route::get('/reserv', [ReservationController::class, 'index']);
    Route::post('/reservation', [ReservationController::class, 'store'])
        ->name('reservation.store')->middleware('auth:sanctum');
    Route::prefix('api')->group(function () {
        // Route::get('/reservations', [ReservationController::class,'index']);
        Route::post('/cancel', [ReservationController::class, 'cancel']);
        ///evaluation..........................
        Route::post('/evaluation', [EvaluationController::class, 'store']);
        Route::get('/showEvaluation', [EvaluationController::class, 'showEvaluation']);
    });

    Route::get('f', [ReservationController::class, 'index']);
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit']);

    Route::post('/reservation/update/{id}', [ReservationController::class, 'update']);

});

Route::middleware('auth:api')->group(function () {
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::post('reservations/store', [ReservationController::class, 'store']);
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit']);
    Route::put('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);
});
Route::get('/reservatiy', [ReservationController::class, 'getAllReservations']);

