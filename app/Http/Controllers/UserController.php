<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user(); // get the currently authenticated user
        return view('user.display-profile', compact('user')); // pass user to the view
    }
}
