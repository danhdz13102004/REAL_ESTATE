<?php

use App\Http\Controllers\ApiController\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\ListingRatingController;
use App\Http\Controllers\ListingVideoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorController;
use App\Http\Controllers\LoginController\GoogleLoginController;
use App\Http\Controllers\LoginController\FacebookLoginController;
use App\Http\Controllers\PaymentOnline\ZaloPaymentController;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index'])->name('index');
Route::get('/hello',[IndexController::class,'show']);


// Route::resource('/listings',ListingController::class)->only(['create','update','store','edit','destroy'])->middleware('auth');
Route::resource('/listings',ListingController::class)->only(['index','show'])->withTrashed();

Route::get('users/{user}',[UserController::class,'index']);

Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/create',[AuthController::class,'create'])->name('create');
Route::get('/login',[AuthController::class,'login_view'])->name('login_view');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::delete('/logout',[AuthController::class,'logout'])->name('logout');


Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function () {
    Route::resource('listings',RealtorController::class)->except(['show'])->withTrashed();
    Route::patch('/listing/{listing}/restore',[RealtorController::class,'restore'])->name('listings.restore')->withTrashed();
    Route::resource('listings.image', ListingImageController::class)->only(['create','store','destroy']);
    Route::resource('listings.video', ListingVideoController::class)->only(['destroy']);
    Route::resource('listings.rating', ListingRatingController::class)->only(['store']);
});

Route::get('/verify/{id}',[RealtorController::class,'verify'])->name('verify');

// Login with google

Route::get('/auth/google/redirect',[GoogleLoginController::class,'redirect'])->name('google.redirect');
 
Route::get('/auth/google/callback',[GoogleLoginController::class,'callback'])->name('google.callback');

Route::get('/auth/facebook/redirect',[FacebookLoginController::class,'redirect'])->name('facebook.redirect');
 
Route::get('/auth/facebook/callback',[FacebookLoginController::class,'callback'])->name('facebook.callback');

Route::resource('listings.offer', ListingOfferController::class)
                ->middleware('auth')
                ->only(['store','index','update']);


Route::prefix('notification')->name('notification.')->middleware('auth')->group(function() {
    Route::get('/',[NotificationController::class,'index'])->name('index');
    Route::patch('/{notification}',[NotificationController::class,'update'])->name('update');
    Route::put('/markAll',[NotificationController::class,'markAll'])->name('markall');
});

Route::resource('zalopayment',ZaloPaymentController::class)->middleware('auth')->only(['index','store']);

// Route::get('/mail',function() {
//     $user = User::find(3);
//     Mail::to($user->email)->send((new VerificationMail($user)));
// });