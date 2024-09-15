<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserGroupController;

Route::group(['middleware' => 'auth'], function () {
    // Groups
    Route::resource('groups', GroupController::class)->only('destroy', 'store', 'show');

    Route::delete('groupsUser/', [GroupController::class, 'leaveGroup'])->name('groups.leave')->middleware('auth');

    Route::delete('RemoveGroupUser/{user}/{group}', [GroupController::class, 'removeUserGroup'])->name('groups.remove')->middleware('auth');

    Route::group(['prefix' => 'groupUser'], function () {
        Route::put('/{group}', UserGroupController::class)->name('groupUser.update');
        Route::delete('/{group}', UserGroupController::class)->name('groupUser.destroy');
    });

    Route::put('groupName/{group}', [GroupController::class, 'updateName'])->name('groupName.update');
});