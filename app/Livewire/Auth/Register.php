<?php

namespace App\Livewire\Auth;

use App\Mail\SendVerificationCode;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mail;

class Register extends Component
{
    #[Validate(['required', 'max:255'])]
    public $name;

    #[Validate(['required', 'min:5', 'max:255', 'unique:users'])]
    public $username;

    #[Validate(['required', 'email', 'max:255', 'unique:users'])]
    public $email;

    #[Validate(['required', 'min:6', 'confirmed'])]
    public $password;
    public $password_confirmation;


    public function registerUser()
    {
        $validated = $this->validate();

        $user = User::create($validated);

        $profile = $user->profile()->create([
            'user_id' => $user->id,
            'image' => $this->username . ".png",
            'bio' => 'Write something about yourself',
        ]);

        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . $profile->image));

        Auth::login($user);

        $code = rand(100000, 999999);

        auth()->user()->verifications()->create([
            'code' => $code,
            'expired_at' => now()->addHours(2),
        ]);

        Mail::to($this->email)->send(new SendVerificationCode($code));

        return redirect()->route('verify');
    }

    public function render(): Factory|Application|View
    {
        return view('livewire.auth.register');
    }
}
