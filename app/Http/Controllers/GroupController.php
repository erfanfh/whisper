<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, Group $group)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request, User $user, Group $group)
    {
        $user = Auth::user();
        $group = Group::create([
            'name' => $request->name,
            'user_id' => $user->id
        ]);

        $user->groups()->save($group);

        foreach ($request->collect()->except(['_token', 'name']) as $key => $value) {
            $user = User::find($key);
            $user->groups()->save($group);
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Group $group, Post $post): View
    {
        if(empty(auth()->user()->groups->where('id', $group->id)->collect()->all())) {
            abort(404);
        }

        $post = Post::where('group_id', $group->id)->latest()->get();

        return view('groups.show', ['group' => $group, 'posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
