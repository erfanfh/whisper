<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    // Users
    Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/{username}/contact', [ContactController::class, 'store'])->name('contact.add');
    Route::put('/{username}/contact', [ContactController::class, 'update'])->name('contact.edit');
    Route::delete('/{username}/contact', [ContactController::class, 'destroy'])->name('contact.delete');
});
