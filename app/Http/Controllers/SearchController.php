<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $users = User::where('username', 'Like', '%' . $request['q'] . '%')->orWhere('name', 'Like', '%' . $request['q'] . '%')->get();
        return view('users.index', ['users' => $users]);
    }
}
