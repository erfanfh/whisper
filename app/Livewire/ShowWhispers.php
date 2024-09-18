<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ShowWhispers extends Component
{
    public $group;

    protected $listeners = [
        'postsAdded' => 'render',
    ];

    public function render(): Application|Factory|View
    {
        $posts = $this->group->posts->reverse();

        return view('livewire.show-whispers', compact('posts'));
    }
}
