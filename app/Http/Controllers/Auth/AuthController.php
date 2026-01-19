<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request)
    {
        $this->user->create($request->validated());

        return redirect('/login')->with('success', 'Register berhasil');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }

            Auth::logout();
            return redirect('/login')->withErrors('Role tidak dikenali');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
