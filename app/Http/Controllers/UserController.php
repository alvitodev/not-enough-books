<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Tidak terpakai, bisa dihapus jika tidak ada method lain yang butuh
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function showProfile()
    {
        $user = Auth::user(); // get the currently authenticated user
        return view('user.display-profile', compact('user')); // pass user to the view
    }
}