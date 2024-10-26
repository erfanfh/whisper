<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\UserMustBeUnverified;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::group(['middleware' => [UserMustBeUnverified::class]], function () {
        Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
        Route::post('/verify', [AuthController::class, 'verifyPost'])->name('verify.post');
        Route::post('/resend-verification', [AuthController::class, 'changeEmail'])->name('verify.change.email');
        Route::get('/resend-verification', [AuthController::class, 'resendVerification'])->name('verify.resend');
    });
});
