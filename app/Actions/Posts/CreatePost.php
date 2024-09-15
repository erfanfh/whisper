<?php

namespace App\Actions\Posts;

use App\Actions\Action;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Action
{
    /**
     * create a new post
     *
     */
    public function handle($request, ?string $group = null): void
    {
        Post::create([
            'message' => $request->message,
            'user_id' => Auth::id(),
            'group_id' => $group
        ]);
    }
}
