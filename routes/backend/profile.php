<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    // Profile
    Route::put('profile', [ProfileController::class, 'profilePost'])->name('profile.post');

    Route::delete('profile', [ProfileController::class, 'profileDelete'])->name('profile.delete');
});
