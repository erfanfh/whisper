<?php

namespace App\Actions\Profile;
use App\Actions\Action;

class DeleteProfile extends Action
{
    public function copy()
    {
        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . auth()->user()->profile->image));
    }
}
