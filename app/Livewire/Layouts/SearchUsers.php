<?php

namespace App\Livewire\Layouts;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Spatie\QueryBuilder\QueryBuilder;
use Str;

class SearchUsers extends Component
{
    public $search = '';
    public $perPage = 5;

    public function searchUser()
    {
        //
    }

    public function loadMore(): void
    {
        $this->perPage += 5;
    }

    public function render(): Application|Factory|View
    {
        sleep(1);

        $users = collect();

        if (Str::length($this->search) < 3) {
            return view('livewire.layouts.search-users', compact('users'));

        }

        $users = QueryBuilder::for(User::class)
            ->where('username', 'Like', '%' . $this->search . '%')
            ->orWhere('name', 'Like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.layouts.search-users', compact('users'));
    }
}
