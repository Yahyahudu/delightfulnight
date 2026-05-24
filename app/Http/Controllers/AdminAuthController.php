<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin-login');
    }

  // AdminAuthController.php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        Auth::logout();
        return back()->withErrors(['email' => 'You are not authorized as admin.']);
    }
    return back()->withErrors(['email' => 'Invalid credentials.']);
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}