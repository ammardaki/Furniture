<?php


use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FurnitureSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\web\FurnitureWebController;
use App\Http\Controllers\Web\AdsController;
use App\Http\Controllers\Web\WebCommentController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('web')->group(function () {
    Route::resource('reservations', WebReservationController::class, ['as' => 'web']);
});
Route::get('/', function () {
    return view('welcomey');
});
Route::get('/furniture-data', [FurnitureController::class, 'getFurnitureData']);
##Route::get('/furniture/{id}', 'FurnitureController@show')->name('furniture.show');
Route::get('/furniture/{id}', [FurnitureController::class, 'showbyid'])->name('furniture.show');
Route::get('/furnitur/{id}', [FurnitureController::class, 'Ashowbyid'])->name('furnitur.Ashow');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');



Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');


Route::resource('reservations', BookingController::class);
Route::get('/reservations/get', [BookingController::class, 'index'])->name('reservations.index');
// Route::get('/reservations/create', [BookingController::class, 'create'])->name('reservations.create');
// Route::post('/reservations/add', [BookingController::class, 'store'])->name('reservations.store');
Route::get('/reservations/create', [BookingController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [BookingController::class, 'store'])->name('reservations.store');
// Route::get('/reservations/{id}/edit', [BookingController::class, 'edit'])->name('reservations.edit');
// Route::put('/reservations/{id}', [BookingController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{id}', [BookingController::class, 'destroy'])->name('reservations.destroy');
// Route::get('/allfurniture', [FurnitureController::class, 'getAllView'])->name('allfurniture.view');
// Route::get('/allfurniture', function(){
//     return view('allfurniture');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/api/furniture', [FurnitureController::class, 'getAll']);
Route::get('/homeadmin', [HomeController::class, 'admindex'])->name('homeadmin');

Route::prefix('furnitures')->group(function () {
  //  Route::get('create', [FurnitureWebController::class, 'create'])->name('furnitures.create');
});
Route::get('/create', [App\Http\Controllers\web\FurnitureWebController::class, 'create'])->name('furnitures.create');
Route::post('/ads/store', [App\Http\Controllers\web\AdsController::class, 'StoreAds'])->name('ads.store');

//furniture web 
//Route::get('/ads', [App\Http\Controllers\web\AdsController::class, 'index'])->name('ads.index');

//Route::post('store', [App\Http\Controllers\web\AdsController::class, 'StoreAds'])->name('furnitures.store');
Route::delete('/ad/{id}', [App\Http\Controllers\web\AdsController::class, 'destroyAds'])->name('furniture.destroy');
// Route::get('/ad/{id}', [App\Http\Controllers\web\AdsController::class, 'destroyAds'])->name('furniture.destroy');

//ADS WEB
Route::post('store', [FurnitureWebController::class, 'store'])->name('furnitures.store');
Route::delete('/furnitur/{id}', [App\Http\Controllers\web\FurnitureWebController::class, 'destroy'])->name('furniture.destroy');
//Route::resource('/ads', [App\Http\Controllers\web\AdsController::class]);
Route::get('/ad', [App\Http\Controllers\web\AdsController::class, 'index'])->name('ads.index');

// مسار لعرض تفاصيل إعلان معين
Route::get('/adsa', [AdsController::class, 'index'])->name('adss');
Route::get('/ads/{id}', [AdsController::class, 'show'])->name('ads.show');Route::get('/adsa', [AdsController::class, 'index'])->name('ads.index');
Route::get('/ad', [AdsController::class, 'indext'])->name('ads.index');
Route::post('/storea', [AdsController::class, 'StoreAds'])->name('ads.store');
Route::get('/ad/success', [App\Http\Controllers\web\AdsController::class, 'success'])->name('ads.success');
//بحث
Route::get('/search', [FurnitureSearchController::class, 'search'])->name('search.furniture');
//حجز
// Show booking form
Route::get('/booking/create', [BookingController::class, 'showForm'])->name('booking.form');
//show all
// Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

// Store booking data
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
// Show booking success
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
// Delete booking
// Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/Adbookings', [BookingController::class, 'getAllReservations'])->name('booking.adindex');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/succes', [BookingController::class, 'successe'])->name('booking.successde');
});
//comment
Route::get('/comment', [WebCommentController::class, 'index'])->name('comment.index');
Route::get('/commey', [WebCommentController::class, 'inde'])->name('comment.inde');
Route::post('/add/comment', [App\Http\Controllers\web\WebCommentController::class, 'store'])->name('comment.store');
Route::get('/add/comment', [App\Http\Controllers\web\WebCommentController::class, 'store'])->name('comment.create');


Route::post('/add/evaluation', [App\Http\Controllers\web\WebEvaluationController::class, 'store'])->name('evaluation.store');
Route::get('/comment/success', [WebCommentController::class, 'success'])->name('comment.success');
