<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
{
    $user = Auth::user();
    return view('user.edit-profile', compact('user'));
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // ✅ This guarantees you're using the Eloquent model
    $user = User::findOrFail(Auth::id());

    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save(); // ✅ now this works!

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}

public function showUser()
{
    $user = Auth::user();
    return view('content.home', compact('user'));
}

public function showAdmin()
{
    $user = Auth::user();
    return view('content-admin.home', compact('user'));
}

}
