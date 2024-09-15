<?php

namespace App\Actions\Profile;

use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends Action
{
    public function storeProfile($request, $extension): void
    {
        $request->file('profile')->storeAs("Profiles", auth()->user()->username . "." . $extension);

    }
    public function defaultProfile($extension): void
    {
        auth()->user()->profile()->update([
            'image' => Auth::user()->username . "." . $extension,
        ]);
    }

    public function updateProfile($request): void
    {
        auth()->user()->profile()->update([
            'image' => $request->username . '.png'
        ]);
    }

    public function updateUser($request): void
    {
        auth()->user()->update($request);
    }

    public function updateBio($request): void
    {
        auth()->user()->profile()->update([
            'bio' => $request->bio,
        ]);
    }

    public function copy(): void
    {
        copy(storage_path("app/Profiles/") . auth()->user()->profile->image, public_path("Images/Profiles/" . auth()->user()->profile->image));
    }

    public function unlink(): void
    {
        unlink(storage_path("app/Profiles/") . auth()->user()->profile->image);
    }

    public function rename($request)
    {
        rename(public_path('Images/Profiles/') . auth()->user()->username . '.png', public_path('Images/Profiles/') . $request->input('username') . ".png");
    }
}
