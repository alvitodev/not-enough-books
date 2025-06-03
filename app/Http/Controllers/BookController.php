<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {

        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' dalam ' . $category->name;
        }

        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' oleh ' . $author->name;
        }

        return view('book', [
            "title" => "Book" . $title,
            "posts" => Book::with(['author', 'category'])->latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Book $book) {
        
        return view('content.book', [
            "title" => "Single Book",
            "book" => $book
        ]);

    }
}
