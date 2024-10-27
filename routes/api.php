<?php

use App\Http\Controllers\ApiController\ListingController;
use App\Http\Controllers\ApiController\UserController;
use App\Http\Controllers\PaymentOnline\ZaloPaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('users/{user}',[UserController::class,'index']);

Route::get('listings/{page}',[ListingController::class,'index']);

Route::post('zalopayment/callback',[ZaloPaymentController::class,'callback'])->name('zalopayment.callback');

Route::get('zalopayment/getstatus',[ZaloPaymentController::class,'status']);