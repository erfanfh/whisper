<?php

use App\Http\Controllers\PostController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
});
