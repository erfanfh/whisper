<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Post::all();
        return view('dashboard', ['posts' => Post::latest()->get()]);
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
        $validated = $request->validate(
            [
                'message' => 'required|max:10000',
            ],
            [
                'message.required' => "Say something :)"
            ]
        );

        Post::create([
            'message' => $request->message,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('success', 'Whisper created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Gate::denies('update', $post)) {
            abort(404);
        }
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Gate::denies('update', $post)) {
            abort(404);
        }

        if ($post->message === $request->get('message')) {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'message' => 'required|max:10000',
        ]);

        $post->update([
            'message' => $request->message,
        ]);

        $post->edited = 1;

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Whisper updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Gate::denies('delete', $post)) {
            abort(404);
        }

        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Whisper has been deleted');
    }
}
