<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginUserRequest;
use App\Mail\SendVerificationCode;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mail;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
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

    public function verify()
    {
        if (empty(auth()->user()->verifications->where('status', 1)->where('expired_at', '>', now())->first())) {
            $code = rand(100000, 999999);

            auth()->user()->verifications()->create([
                'code' => $code,
                'expired_at' => now()->addHours(2),
            ]);

            Mail::to(auth()->user()->email)->send(new SendVerificationCode($code));
        }

        return view('auth.verify-email');
    }

    public function verifyPost(Request $request)
    {
        if (auth()->user()->verifications->where('status', 1)->where('expired_at', '>', now())->last()->code == $request->code) {
            auth()->user()->update(['email_verified_at' => now()]);
            auth()->user()->verifications->last()->update([
                'expired_at' => now(),
                'status' => 0,
            ]);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('verify')->with('error', 'Verification code is invalid');
        }
    }

    public function resendVerify(Request $request)
    {
        if (auth()->user()->email == $request->email) {
            return redirect()->route('verify');
        }

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ]
        ]);

        auth()->user()->update([
            'email' => $validated['email'],
        ]);

        $code = rand(100000, 999999);

        auth()->user()->verifications()->create([
            'code' => $code,
            'expired_at' => now()->addHours(2),
        ]);

        Mail::to(auth()->user()->email)->send(new SendVerificationCode($code));

        return redirect()->route('verify');
    }
}
