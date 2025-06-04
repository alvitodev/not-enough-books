<?php

namespace App\Http\Controllers\Auth; // Tetap di namespace Auth

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm() // Method baru untuk menampilkan form
    {
        return view('user.login', [ // Asumsi view login ada di user.login
            'title' => 'Login',
            'keyt' => 'login' // Jika keyt masih relevan
        ]);
    }

    /**
     * Handle an authentication attempt.
     */
    public function store(Request $request) // Mengganti nama dari authenticate atau store yang lama
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            // is_admin divalidasi jika memang dikirim dari form dan dibutuhkan untuk attempt
            // Jika tidak, cukup email dan password saja.
            // Jika 'is_admin' dikirim dari form dan ingin disertakan dalam attempt:
            // 'is_admin' => 'required|in:0,1', // Pastikan form mengirimkan ini
        ]);

        // Jika is_admin ingin disertakan dalam proses attempt:
        // $authCredentials = [
        //     'email' => $credentials['email'],
        //     'password' => $credentials['password'],
        // ];
        // if (isset($credentials['is_admin'])) {
        //     $authCredentials['is_admin'] = $credentials['is_admin'];
        // }

        // Jika is_admin tidak perlu saat attempt, cukup:
        $authCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        $remember = $request->filled('remember');

        if (Auth::attempt($authCredentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->is_admin == 1) { // Menggunakan $user->is_admin setelah berhasil login
                return redirect()->intended(route('admin.dashboard')); // Menggunakan nama rute admin
            } else {
                return redirect()->intended(route('home')); // Menggunakan nama rute home
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('landing')); // Redirect ke landing page setelah logout
    }
}