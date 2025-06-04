<?php

namespace App\Http\Controllers\Auth; // Tetap di namespace Auth

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan ini adalah model User yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator; // Tidak terpakai di implementasi ini

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function showRegistrationForm() // Method baru untuk menampilkan form
    {
        return view('user.create', [ // Asumsi view register ada di user.create
            'title' => 'Register',
            'keyt' => 'register' // Jika keyt masih relevan
        ]);
    }

    /**
     * Handle a registration request for the application.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username', // Tambahkan nama tabel untuk unique rule
            'email' => 'required|string|email|max:255|unique:users,email',    // Tambahkan nama tabel
            'password' => 'required|string|min:6', // Laravel default biasanya min:8 untuk keamanan
            'role' => 'required|in:user,admin', // Validasi role
        ]);

        // Model User sudah memiliki casting 'password' => 'hashed'
        // jadi Hash::make() di sini menjadi eksplisit saja, bisa juga dihilangkan jika percaya pada casting.
        // Namun, untuk hashing password saat create, eksplisit lebih aman.
        User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Pastikan password di-hash
            'is_admin' => $validatedData['role'] === 'admin' ? 1 : 0,
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }
}