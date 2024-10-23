<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
});
