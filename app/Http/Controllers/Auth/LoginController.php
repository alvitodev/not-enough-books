<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'is_admin' => 'required|in:0,1',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => $request->is_admin,
        ];

        $remember = $request->filled('remember');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect user based on role
            if ($request->is_admin == 1) {
                return redirect()->intended('/home-admin');
            } else {
                return redirect()->intended('/home');
            }
        }

        // Failed login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/home'); // Redirect where you want after logout
    }
}

