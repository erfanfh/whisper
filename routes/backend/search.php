<?php

use App\Http\Controllers\SearchController;

Route::group(['middleware' => 'auth'], function () {
    // Search
    Route::post('search', SearchController::class)->name('search');
});
