<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create($validatedData);


        $profile = $user->profile()->create([
            'user_id' => $user->id,
            'image' => $request->username . ".png",
            'bio' => 'Write something about yourself',
        ]);

        copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . $profile->image));

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request, User $user)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        $users = User::where('username', $credentials['email'])->get()->all();
        if(!empty($users)) {
            if(Hash::check($credentials['password'], $users[0]->password)) {
                Auth::loginUsingId($users[0]->id);
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login')->with('error', 'Login details are not valid');
    }

    public function logout(Request $request)
    {
        Auth::logout($request);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function profile(Request $request)
    {
        return view('auth.profile', ['user' => $request->user()]);
    }

    public function profilePost(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'bio' => 'nullable|max:255',
            'profile' => 'nullable|max:1000|image',
        ]);

        if ($request->hasFile('profile')) {

            $extension = $request->file('profile')->getClientOriginalExtension();

            $request->file('profile')->storeAs("Profiles",  auth()->user()->username . "." . $extension);

            auth()->user()->profile()->update([
                'image' => Auth::user()->username . "." . $extension,
            ]);
        }

        if ($request->input('delete-profile') == "on") {
            copy(public_path("Images/Profiles/") . "User-avatar.png", public_path("Images/Profiles/" . auth()->user()->profile->image));
//            auth()->user()->profile()->update([
//                'image' => auth()->user()->profile()->image,
//            ]);
        }

        if (auth()->user()->username != $request->input('username')) {
            rename(public_path('Images/Profiles/') . auth()->user()->username . '.png' , public_path('Images/Profiles/') . $request->input('username') . ".png");
            auth()->user()->profile()->image = $request->input('username') . '.png';
            User::find(Auth::id())->profile()->update([
                'image' => $request->input('username') . '.png'
            ]);
        }

        User::find(Auth::id())->update($validatedData);

        User::find(Auth::id())->profile()->update([
            'bio' => $validatedData['bio'],
        ]);

        return redirect()->route('profile.show', ['username' => $request->input('username')])->with('success', 'Profile updated successfully');
    }
}
