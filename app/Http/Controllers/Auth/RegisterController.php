<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',  // Validate role string
        ]);

        // Map role to is_admin boolean
        $isAdmin = $request->role === 'admin' ? 1 : 0;

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => ($request->password),
            'is_admin' => $isAdmin,
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }
}

