<?php

namespace App\Http\Controllers;

use App\Actions\Posts\CreatePost;
use App\Actions\Posts\UpdatePost;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View
    {
        $posts = Post::where('group_id', null)->where('receiver_id', null)
            ->latest()->get();

        return view('dashboard', ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Application|Factory|View
    {
        if (Gate::denies('update', $post)) {
            abort(404);
        }

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post, UpdatePost $updatePost): RedirectResponse
    {
        if (Gate::denies('update', $post)) {
            abort(404);
        }

        $updatePost->handle($request, $post);

        $post->edited = 1;

        $post->save();

        if (is_null($post->group)) {
            return redirect()->route('dashboard')->with('success', 'Whisper updated successfully');
        }

        return redirect()->route('groups.show', $post->group)->with('success', 'Whisper updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        if (Gate::denies('delete', $post)) {
            abort(404);
        }

        $post->delete();

        if (is_null($post->group)) {
            return redirect()->route('dashboard')->with('success', 'Whisper has been deleted');
        }

        return redirect()->route('groups.show', $post->group)->with('success', 'Whisper has been deleted');

    }
}
