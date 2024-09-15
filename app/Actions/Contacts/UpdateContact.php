<?php

namespace App\Actions\Contacts;

use App\Actions\Action;

class UpdateContact extends Action {
    /**
     * update an existing contact
     *
     */
    public function handle($request ,$contact): void
    {
        $contact->update([
            'name' => $request['name'],
        ]);
    }
}
