<?php


use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('home');
})->name('home')->middleware('guest');

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard')->middleware('auth');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('posts', PostController::class)
    ->except('create', 'index')
    ->middleware('auth');

Route::put('profile', [ProfileController::class, 'profilePost'])->name('profile.post')->middleware('auth');
Route::delete('profile', [ProfileController::class, 'profileDelete' ])->name('profile.delete')->middleware('auth');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index')->middleware('auth');
Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/{username}/contact', [ContactController::class, 'store'])->name('contact.add')->middleware('auth');
Route::put('/{username}/contact', [ContactController::class, 'update'])->name('contact.edit')->middleware('auth');
Route::delete('/{username}/contact', [ContactController::class, 'destroy'])->name('contact.delete')->middleware('auth');
