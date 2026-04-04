<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\User;

class LandingController extends Controller
{
   public function index()
{
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'user'  => redirect()->route('user.dashboard'),
        };
    }

    $aspiration = Aspiration::count();
    $user = User::count();

    return view('landing', compact('aspiration', 'user'));
}
}
