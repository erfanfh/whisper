<?php

namespace App\Livewire\Auth;

use App\Actions\Auth\CreateUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate(['required', 'max:255'])]
    public $name;

    #[Validate(['required', 'max:255', 'unique:users'])]
    public $username;

    #[Validate(['required', 'email', 'max:255', 'unique:users'])]
    public $email;

    #[Validate(['required', 'min:6', 'confirmed'])]
    public $password;
    public $password_confirmation;


    public function registerUser()
    {
        $validated= $this->validate();

        $user = User::create($validated);

        $profile = $user->profile()->create([
            'user_id' => $user->id,
            'image' => $this->username . ".png",
            'bio' => 'Write something about yourself',
        ]);

        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . $profile->image));

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
