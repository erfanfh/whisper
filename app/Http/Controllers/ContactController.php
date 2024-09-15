<?php

namespace App\Http\Controllers;

use App\Actions\Contacts\CreateContact;
use App\Actions\Contacts\UpdateContact;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View
    {
        $contacts = Contact::where('user_id', Auth::id())->get();

        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request, CreateContact $createContact): RedirectResponse
    {
        $user = User::where('username', collect(explode('/', $request->path()))->first())->firstOrFail();

        $createContact->handle($request, $user);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): Application|Factory|View
    {
        return view('contact.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, UpdateContact $updateContact): RedirectResponse
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $updateContact->handle($request, $contact);

        return redirect()->back()->with(['success' => 'Contacts update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(string $username): RedirectResponse
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $contact->delete();

        return redirect()->back()->with(['success' => 'Contacts deleted successfully']);
    }
}
