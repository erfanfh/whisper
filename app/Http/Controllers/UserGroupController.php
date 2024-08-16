<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function updateUser(Request $request, Group $group)
    {
        if (is_null($request->input('user'))) {
            return redirect()->back();
        }

        $user = User::find($request->input('user'));

        $user->groups()->save($group);

        return redirect()->back()->with('success', $user->name . ' added successfully');
    }
}
