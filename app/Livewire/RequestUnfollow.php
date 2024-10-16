<?php

namespace App\Livewire;

use Livewire\Component;

class RequestUnfollow extends Component
{
    public $unfollow;

    public $user;

    public function unfollow()
    {

    }

    public function render()
    {
        return view('livewire.request-unfollow');
    }
}
