<?php

namespace App\Actions\Posts;

use App\Actions\Action;

class UpdatePost extends Action
{
    /**
     * update a post
     */
    public function handle($request, $post): void
    {
        $post->update([
            'message' => $request->message,
        ]);
    }
}
