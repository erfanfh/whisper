<?php

namespace App\Http\Controllers;

use App\Actions\Groups\CreateGroup;
use App\Actions\Groups\UpdateGroupName;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupNameRequest;
use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request, CreateGroup $createGroup): RedirectResponse
    {
        $user = Auth::user();

        $group = $createGroup->handle($request, $user);

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
        if (empty(auth()->user()->groups->where('id', $group->id)->collect()->all())) {
            abort(404);
        }

        $post = Post::where('group_id', $group->id)->latest()->get();

        return view('groups.show', ['group' => $group, 'posts' => $post]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('dashboard');
    }

    public function leaveGroup(Request $request, Group $group): RedirectResponse
    {
        auth()->user()->groups()->detach($group->id);

        Post::create([
            'message' => auth()->user()->name . ' left the group',
            'group_id' => $group->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function removeUserGroup(User $user, Group $group): RedirectResponse
    {
        if ($user->id == auth()->user()->id) {
            return redirect()->back();
        }

        $user->groups()->detach($group->id);

        Post::create([
            'message' => auth()->user()->name . ' removed ' . $user->name,
            'group_id' => $group->id,
        ]);

        return redirect()->back();

    }

    public function updateName(UpdateGroupNameRequest $request, Group $group, UpdateGroupName $updateGroupName): RedirectResponse
    {
        $updateGroupName->handle($request, $group);

        Post::create([
            'message' => auth()->user()->name . ' changed the group name to ' . '\'' . $group->name . '\'',
            'group_id' => $group->id,
        ]);

        return redirect()->back()->with('success', $group->name . ' changed successfully');
    }
}
