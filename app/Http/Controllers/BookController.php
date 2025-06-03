<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function home()
    {
        // Example: get 4 latest books
        $recentBooks = Books::orderBy('id', 'desc')->take(4)->get();
    
        // Example: get 4 recently added books (can be same as latest or customized)
        $latestBooks = Books::orderBy('year', 'desc')->take(4)->get();
    
        return view('content.home', compact('latestBooks', 'recentBooks'));
    }
}
