<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;


// Buat ngetes yakk
Route::get('/', function () {
    return view('content.landing');
});

//home page
Route::get('/home', function () {
    return view('content.home',[
        'books' => Book::latest()->get()
    ]);
});

//home page
Route::get('/layout', function () {
    return view('layouts.primary');
});

Route::get('/libraries', function () {
    return view('content.libraries');
});

Route::get('/latest', function () {
    return view('content.latest');
});

Route::get('/recently', function () {
    return view('content.recently');
});
Route::get('/category', function () {
    return view('content-admin.category');
});


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);



Route::get('/editprofile', [ProfileController::class, 'index']);

Route::get('/profile', function () {
    return view('user.edit-profile');
});
Route::get('/admin', function () {
    return view('layouts.admin');
});
Route::get('/search', function () {
    return view('content.search');
});
Route::get('/edit-book', function () {
    return view('content-admin.edit-book');
});
Route::get('/add-book', function () {
    return view('content-admin.add-book');
});

Route::get('/book/{book:slug}', [BookController::class, 'show']);



//test komen hehe -putmul
