<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostWhisper extends Component
{
    public $group;

    public $message;

    protected $rules = [
        'message' => 'required',
    ];

    protected $messages = [
        'message' => 'Say something ;)',
    ];

    public function post(): void
    {
        $this->validate();

        Post::create([
            'message' => $this->message,
            'user_id' => Auth::id(),
            'group_id' => $this->group->id,
        ]);

        $this->reset('message');

        $this->dispatch('postsAdded');
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.post-whisper');
    }
}
