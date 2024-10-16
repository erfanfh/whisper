<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('guest');

require __DIR__ . '/backend/auth.php';

require __DIR__ . '/backend/dashboard.php';

require __DIR__ . '/backend/posts.php';

require __DIR__ . '/backend/groups.php';

require __DIR__ . '/backend/profile.php';

require __DIR__ . '/backend/request.php';

require __DIR__ . '/backend/email.php';

require __DIR__ . '/backend/contacts.php';

require __DIR__ . '/backend/users.php';
