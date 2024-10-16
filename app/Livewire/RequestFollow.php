<?php

namespace App\Livewire;

use Livewire\Component;

class RequestFollow extends Component
{
    public $follow;

    public $user;

    public function follow()
    {
        dd("vb");
    }
    public function render()
    {
        return view('livewire.request-follow');
    }
}
