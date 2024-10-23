<?php

use App\Http\Controllers\ContactController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    // Contacts
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
});
