<?php

use App\Http\Controllers\PostController;
use App\Http\Middleware\UserMustBeVerified;

Route::group(['middleware' => ['auth', UserMustBeVerified::class]], function () {
    // Posts
    Route::resource('posts', PostController::class)
        ->except('create', 'show', 'store');

    Route::post('posts/{group?}', [PostController::class, 'store'])->name('posts.store');
});
