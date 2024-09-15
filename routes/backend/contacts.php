<?php

use App\Http\Controllers\ContactController;

Route::group(['middleware' => 'auth'], function () {
    // Contacts
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
});
