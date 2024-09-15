<?php

namespace App\Actions\Contacts;

use App\Actions\Action;
use App\Models\Contact;

class CreateContact extends Action {
    /**
     * create new contact
     *
     */
    public function handle($request, $user): void
    {
        Contact::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'belongs_id' => $user->id,
        ]);
    }
}
