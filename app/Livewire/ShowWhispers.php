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
        if(empty($this->group->users->where('id', auth()->id())->all())) {
            $this->redirect('/');
        }

        $posts = $this->group->posts->reverse();

        return view('livewire.show-whispers', compact('posts'));
    }
}
