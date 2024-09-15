<?php

namespace App\Actions\Groups;

use App\Actions\Action;

class UpdateGroupName extends Action
{
    /**
     * update a group name
     *
     */
    public function handle($request, $group): void
    {
        $group->update([
            'name' => $request->name,
        ]);
    }
}
