<?php

namespace App\Http\Controllers;

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
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $user = User::where('username', collect(explode('/', $request->path()))->first())->firstOrFail();

        Contact::create([
            'name' => $request['name'],
            'user_id' => auth()->user()->id,
            'belongs_id' => $user->id,
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): Application|Factory|View
    {
        return view('contact.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $contact->update([
            'name' => $request['name'],
        ]);

        return redirect()->back()->with(['success' => 'Contact update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username): RedirectResponse
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $contact->delete();

        return redirect()->back()->with(['success' => 'Contact deleted successfully']);
    }
}
