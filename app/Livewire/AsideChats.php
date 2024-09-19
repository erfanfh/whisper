<?php

namespace App\Livewire;

use App\Models\Group;
use Livewire\Component;

class AsideChats extends Component
{
    public $group;

    protected $listeners = [
        'postsAdded' => 'render',
    ];

    public function render()
    {
        return view('livewire.aside-chats');
    }
}
