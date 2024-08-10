<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::where('username', collect(explode('/', $request->path()))->first())->firstOrFail();

        $request->validate([
            'name' => 'required|max:50',
        ]);

        Contact::create([
           'name' => $request['name'],
           'user_id'=> auth()->user()->id,
            'belongs_id' => $user->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
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
    public function update(Request $request, string $username)
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $contact->update([
            'name' => $request['name'],
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username)
    {
        $user = User::where('username', $username)->get()->firstOrFail();

        $contact = auth()->user()->contacts->where('belongs_id', $user->id)->first();

        $contact->delete();

        return redirect()->back();
    }
}
