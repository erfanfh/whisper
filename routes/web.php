<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Route;


// Must Unauthenticated Routes

Route::group(['middleware' => 'guest'], function () {

    // Home
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // Auth
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});


// Must Authenticated Routes

Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    // Auth
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Posts
    Route::resource('posts', PostController::class)
        ->except('create', 'show', 'store');

    Route::post('posts/{group?}', [PostController::class, 'store'])->name('posts.store');

    // Groups
    Route::resource('groups', GroupController::class)->only('destroy', 'store', 'show');
    Route::delete('groupsUser/', [GroupController::class, 'leaveGroup'])->name('groups.leave')->middleware('auth');
    Route::delete('RemoveGroupUser/{user}/{group}', [GroupController::class, 'removeUserGroup'])->name('groups.remove')->middleware('auth');

    Route::group(['prefix' => 'groupUser'], function () {
        Route::put('/{group}', [UserGroupController::class])->name('groupUser.update');
        Route::delete('/{group}', [UserGroupController::class])->name('groupUser.destroy');
    });

    // Profile
    Route::put('profile', [ProfileController::class, 'profilePost'])->name('profile.post');

    Route::delete('profile', [ProfileController::class, 'profileDelete'])->name('profile.delete');

    // Search
    Route::post('search', [SearchController::class])->name('search');

    // Email
//    Route::get('/email/verify', function () {
//        return view('auth.verify-email');
//    })->name('verification.notice');
//
//    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//        $request->fulfill();
//        return redirect('/home');
//    })->middleware(['signed'])->name('verification.verify');
//
//    Route::post('/email/verification-notification', function (Request $request) {
//        $request->user()->sendEmailVerificationNotification();
//        return back()->with('message', 'Verification link sent!');
//    })->middleware(['throttle:6,1'])->name('verification.send');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

    // Users
    Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/{username}/contact', [ContactController::class, 'store'])->name('contact.add');
    Route::put('/{username}/contact', [ContactController::class, 'update'])->name('contact.edit');
    Route::delete('/{username}/contact', [ContactController::class, 'destroy'])->name('contact.delete');
});
