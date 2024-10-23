<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    // Follow
    Route::post('follow/{user}', [ProfileController::class, 'follow'])->name('follow.user');

    // unfollow
    Route::post('unfollow/{user}', [ProfileController::class, 'unfollow'])->name('unfollow.user');
});
