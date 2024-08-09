<?php


use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;


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

Route::get('profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('profile', [AuthController::class, 'profilePost'])->name('profile.post')->middleware('auth');

Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/run-migrations', function () {
    Artisan::call('migrate');
    return 'Migrations have been run successfully!';
});
