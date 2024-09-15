<?php

namespace App\Actions\Auth;

use App\Actions\Action;
use App\Models\User;

class CreateUser extends Action
{
    /**
     * create new user after registration
     *
     */
    public function handle($request, $user) : User
    {
        return $user->profile()->create([
            'user_id' => $user->id,
            'image' => $request->username . ".png",
            'bio' => 'Write something about yourself',
        ]);
    }
}