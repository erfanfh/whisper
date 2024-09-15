<?php

use App\Http\Controllers\PostController;

Route::group(['middleware' => 'auth'], function () {
    // Posts
    Route::resource('posts', PostController::class)
        ->except('create', 'show', 'store');

    Route::post('posts/{group?}', [PostController::class, 'store'])->name('posts.store');
});
