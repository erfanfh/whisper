<?php

namespace App\Actions\Groups;

use App\Actions\Action;
use App\Models\Group;

class CreateGroup extends Action {
    /**
     * create a new group
     *
     */
    public function handle($request, $user) : Group
    {
        return Group::create([
            'name' => $request->name,
            'user_id' => $user->id
        ]);
    }
}
