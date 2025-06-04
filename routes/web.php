<?php

use App\Models\Books; // Menggunakan nama model yang dikonfirmasi: Books
use Illuminate\Support\Facades\Route;

// Controller Utama
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController; // Untuk menampilkan profil pengguna

// Controller Autentikasi (dari namespace Auth)
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page
Route::get('/', function () {
    return view('content.landing');
})->name('landing');

// Home page (Guest & Authenticated User)
Route::get('/home', [BookController::class, 'home'])->name('home');

// Halaman statis atau dengan logika sederhana (pertimbangkan pindah ke controller jika kompleks)
Route::get('/libraries', function () {
    return view('content.libraries');
})->name('libraries');

Route::get('/recently', function () {
    return view('content.recently');
})->name('recently');

Route::get('/latest', function () {
    return view('content.latest');
})->name('latest');
Route::get('/category', function () {
    return view('content.category');
})->name('category');
Route::get('/search', function () {
    return view('content.search');
})->name('');
Route::get('/book', function () {
    return view('content.book');
})->name('book');

//method admin

Route::get('/add-book', function () {
    return view('content-admin.add-book');
})->name('add-book');

Route::get('/edit-book', function () {
    return view('content-admin.edit-book');
})->name('edit-book');

Route::get('/latest-admin', function () {
    return view('content-admin.latest');
})->name('latest-admin');

Route::get('/recently-admin', function () {
    return view('content-admin.recently');
})->name('recently-admin');

Route::get('/libraries-admin', function () {
    return view('content-admin.libraries');
})->name('libraries-admin');

Route::get('/category-admin', function () {
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
})->name('category-admin');

//user login & profile

Route::get('/login', function () {
    return view('user.login');
})->name('login');
Route::get('/create', function () {
    return view('user.create');
})->name('create');

//create user account

use App\Http\Controllers\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

//login user account

use App\Http\Controllers\Auth\LoginController;

Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); //logout user account

//display profile

use App\Http\Controllers\UserController;

Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');

//edit profile

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/user/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/user/update', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth'])->group(function () {
    Route::get('content/home', [ProfileController::class, 'showUser'])->name('home');
    Route::get('/content-admin/home', [ProfileController::class, 'showAdmin'])->name('home-admin'); //return based role
});

//method show books

use App\Http\Controllers\BookController;

//admin

Route::get('/home-admin', [BookController::class, 'homeAdmin'])->name('home-admin'); //home
Route::get('/books-admin/{id}', [BookController::class, 'showAdmin'])->name('books.show-admin');
Route::get('/latest-admin', [BookController::class, 'latestAdmin'])->name('latest-admin'); //latest
Route::get('/recently-admin', [BookController::class, 'recentAdmin'])->name('recently-admin'); //recently
Route::get('/category-admin', [BookController::class, 'showCategoryAdmin'])->name('category-admin');
Route::get('/category-admin/{category}', [BookController::class, 'showBooksByCategoryAdmin'])->name('category.show-admin'); //category
Route::get('/books-admin/{id}', [BookController::class, 'recommendAdmin'])->name('books.show-admin'); //recommendation
Route::get('/search-admin', [BookController::class, 'searchAdmin'])->name('search-books-admin'); //search
Route::post('/add-book', [BookController::class, 'store'])->name('books.store'); //add books
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); //delete books

//librariesAdmin

Route::post('/library-admin/add/{bookId}', [BookController::class, 'addToLibraryAdmin'])->middleware('auth')->name('library.add'); //add book to library
Route::get('/libraries-admin', [BookController::class, 'userLibraryAdmin'])->middleware('auth')->name('libraries-admin'); //show library
Route::delete('/library-admin/remove/{bookId}', [BookController::class, 'removeFromLibraryAdmin'])
    ->middleware('auth')
    ->name('library.remove'); //remove books from library

//user

Route::get('/home', [BookController::class, 'home'])->name('home'); //home
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show'); //show book content
Route::get('/books/{id}', [BookController::class, 'recommend'])->name('books.show'); //recommendation
Route::get('/latest', [BookController::class, 'latest'])->name('latest'); //latest
Route::get('/recently', [BookController::class, 'recent'])->name('recently'); //recently
Route::get('/category', [BookController::class, 'showCategory'])->name('category');
Route::get('/category/{category}', [BookController::class, 'showBooksByCategory'])->name('category.show'); //category
Route::get('/search', [BookController::class, 'search'])->name('search-books'); //search

//libraries

Route::post('/library/add/{bookId}', [BookController::class, 'addToLibrary'])->middleware('auth')->name('library.add'); //add book to library
Route::get('/libraries', [BookController::class, 'userLibrary'])->middleware('auth')->name('libraries'); //show library
Route::delete('/library/remove/{bookId}', [BookController::class, 'removeFromLibrary'])
    ->middleware('auth')
    ->name('library.remove'); //remove books from library








