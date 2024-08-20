<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePostRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show(Request $request): Application|Factory|View
    {
        User::where('username', $request->path())->firstOrFail();

        $user = User::where('username', $request->path())->firstOrFail();

        return view('account.profile', ['user' => $user]);
    }

    public function profilePost(ProfilePostRequest $request, Profile $profile): RedirectResponse
    {
        if (Gate::denies('update', $profile)) {
            abort(403);
        }

        if ($request->hasFile('profile')) {
            $extension = $request->file('profile')->getClientOriginalExtension();
            $request->file('profile')->storeAs("Profiles", auth()->user()->username . "." . $extension);
            auth()->user()->profile()->update([
                'image' => Auth::user()->username . "." . $extension,
            ]);
            copy(storage_path("app/Profiles/") . auth()->user()->profile->image, public_path("Images/Profiles/" . auth()->user()->profile->image));
            unlink(storage_path("app/Profiles/") . auth()->user()->profile->image);
        }

        if (auth()->user()->username != $request->input('username')) {
            rename(public_path('Images/Profiles/') . auth()->user()->username . '.png', public_path('Images/Profiles/') . $request->input('username') . ".png");
            auth()->user()->profile()->image = $request->input('username') . '.png';
            User::find(Auth::id())->profile()->update([
                'image' => $request->input('username') . '.png'
            ]);
        }

        User::find(Auth::id())->update($request->validated());

        User::find(Auth::id())->profile()->update([
            'bio' => $request['bio'],
        ]);

        return redirect()->route('profile.show', ['username' => $request->input('username')])->with('success', 'Profile updated successfully');
    }

    public function profileDelete(Profile $profile): RedirectResponse
    {
        if (Gate::denies('delete', $profile)) {
            abort(404);
        }

        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . auth()->user()->profile->image));

        return redirect()->back()->with('success', 'Profile deleted successfully');
    }
}
