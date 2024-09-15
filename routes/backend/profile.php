<?php

use App\Http\Controllers\ProfileController;

Route::group(['middleware' => 'auth'], function () {
    // Profile
    Route::put('profile', [ProfileController::class, 'profilePost'])->name('profile.post');

    Route::delete('profile', [ProfileController::class, 'profileDelete'])->name('profile.delete');
});
