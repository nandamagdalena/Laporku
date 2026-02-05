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

    public function home()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'user'  => redirect()->route('user.dashboard'),
            default => $this->forceLogout(),
        };
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

        return redirect()
            ->route('login')
            ->with('success', 'Register berhasil, silakan login');
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ]);
        }

        $request->session()->regenerate();

        return match (Auth::user()->role) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'user'  => redirect()->intended(route('user.dashboard')),
            default => $this->forceLogout(),
        };
    }

    private function forceLogout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors('Role tidak dikenali');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
