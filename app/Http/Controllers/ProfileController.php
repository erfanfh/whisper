<?php

namespace App\Http\Controllers;

use App\Actions\Profile\DeleteProfile;
use App\Actions\Profile\UpdateProfile;
use App\Http\Requests\ProfilePostRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show(Request $request): Application|Factory|View
    {
        User::where('username', $request->path())->firstOrFail();

        $user = User::where('username', $request->path())->firstOrFail();

        return view('account.profile', ['user' => $user]);
    }

    public function profilePost(ProfilePostRequest $request, Profile $profile, UpdateProfile $updateProfile): RedirectResponse
    {
        if (Gate::denies('update', $profile)) {
            abort(403);
        }

        if ($request->hasFile('profile')) {
            $extension = $request->file('profile')->getClientOriginalExtension();
            $updateProfile->storeProfile($request, $extension);
            $updateProfile->defaultProfile($extension);
            $updateProfile->copy();
            $updateProfile->unlink();
        }

        if (auth()->user()->username != $request->username) {
            $updateProfile->rename($request);
            $updateProfile->updateProfile($request);
        }

        $updateProfile->updateUser($request->validated());

        $updateProfile->updateBio($request);

        return redirect()->route('profile.show', ['username' => $request->username])->with('success', 'Profile updated successfully');
    }

    public function profileDelete(Profile $profile, DeleteProfile $deleteProfile): RedirectResponse
    {
        if (Gate::denies('delete', $profile)) {
            abort(404);
        }

        $deleteProfile->copy();

        return redirect()->back()->with('success', 'Profile deleted successfully');
    }

    public function follow(User $user)
    {
        auth()->user()->followings()->attach($user->id);
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->followings()->detach($user->id);
        return redirect()->back();
    }
}
