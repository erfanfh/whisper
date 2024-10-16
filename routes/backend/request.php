<?php

use App\Http\Controllers\ProfileController;

Route::group(['middleware' => 'auth'], function () {
    // Follow
    Route::post('follow/{user}', [ProfileController::class, 'follow'])->name('follow.user');

    // unfollow
    Route::post('unfollow/{user}', [ProfileController::class, 'unfollow'])->name('unfollow.user');
});
