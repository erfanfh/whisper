<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        User::where('username', $request->path())->firstOrFail();

        $user = User::where('username', $request->path())->firstOrFail();

        return view('account.profile', ['user' => $user]);
    }
}
