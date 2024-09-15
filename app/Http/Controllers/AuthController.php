<?php

namespace App\Http\Controllers;


use App\Actions\Auth\CreateUser;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    public function registerPost(StoreUserRequest $request, CreateUser $createUser): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create($validated);

        $profile = $createUser->handle($request, $user);

        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . $profile->image));

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('dashboard');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function loginPost(LoginUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        $users = User::where('username', $validated['email'])->get()->all();
        if (!empty($users)) {
            if (Hash::check($validated['password'], $users[0]->password)) {
                Auth::loginUsingId($users[0]->id);
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login')->with('error', 'Login details are not valid');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout($request);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
