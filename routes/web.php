<?php


use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;


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
    ->except('create', 'index', 'store')
    ->middleware('auth');

Route::post('posts/{group?}', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

Route::resource('groups', GroupController::class)->middleware('auth');
Route::delete('groupsUser/', [GroupController::class, 'leaveGroup'])->name('groups.leave')->middleware('auth');
Route::delete('RemoveGroupUser/{user}/{group}', [GroupController::class, 'removeUserGroup'])->name('groups.remove')->middleware('auth');


Route::group(['middleware' => 'auth', 'prefix' => 'groupUser'], function () {
    Route::put('/{group}', [UserGroupController::class, 'updateUser'])->name('groupUser.update');
    Route::delete('/{group}', [UserGroupController::class, 'updateUser'])->name('groupUser.destroy');
});

Route::put('profile', [ProfileController::class, 'profilePost'])->name('profile.post')->middleware('auth');
Route::delete('profile', [ProfileController::class, 'profileDelete' ])->name('profile.delete')->middleware('auth');

Route::post('search',[SearchController::class,'search'])->name('search');

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

Route::get('/group', [GroupController::class, 'index'])->name('group.index')->middleware('auth');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index')->middleware('auth');
Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/{username}/contact', [ContactController::class, 'store'])->name('contact.add')->middleware('auth');
Route::put('/{username}/contact', [ContactController::class, 'update'])->name('contact.edit')->middleware('auth');
Route::delete('/{username}/contact', [ContactController::class, 'destroy'])->name('contact.delete')->middleware('auth');
