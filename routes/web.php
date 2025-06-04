<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page and basic routes
Route::get('/', [BookController::class, 'home'])->name('landing');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/user/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/user/update', [ProfileController::class, 'update'])->name('profile.update');
});

// User content routes
Route::get('/home', [BookController::class, 'home'])->name('home');
Route::get('/latest', [BookController::class, 'latest'])->name('latest');
Route::get('/recently', [BookController::class, 'recent'])->name('recently');
Route::get('/category', [BookController::class, 'showCategory'])->name('category');
Route::get('/category/{category}', [BookController::class, 'showBooksByCategory'])->name('category.show');
Route::get('/search', [BookController::class, 'search'])->name('search-books');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Library routes (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/libraries', [BookController::class, 'userLibrary'])->name('libraries');
    Route::post('/library/add/{bookId}', [BookController::class, 'addToLibrary'])->name('library.add');
    Route::delete('/library/remove/{bookId}', [BookController::class, 'removeFromLibrary'])->name('library.remove');
});

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/home-admin', [BookController::class, 'homeAdmin'])->name('home-admin');
    Route::get('/latest-admin', [BookController::class, 'latestAdmin'])->name('latest-admin');
    Route::get('/recently-admin', [BookController::class, 'recentAdmin'])->name('recently-admin');
    Route::get('/category-admin', [BookController::class, 'showCategoryAdmin'])->name('category-admin');
    Route::get('/category-admin/{category}', [BookController::class, 'showBooksByCategoryAdmin'])->name('category.show-admin');
    Route::get('/books-admin/{id}', [BookController::class, 'showAdmin'])->name('books.show-admin');
    Route::get('/search-admin', [BookController::class, 'searchAdmin'])->name('search-books-admin');

    // Book management
    Route::get('/add-book', function () {
        return view('content-admin.add-book');
    })->name('add-book');
    Route::post('/add-book', [BookController::class, 'store'])->name('books.store');
    Route::get('/edit-book', function () {
        return view('content-admin.edit-book');
    })->name('edit-book');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Admin library management
    Route::get('/libraries-admin', [BookController::class, 'userLibraryAdmin'])->name('libraries-admin');
    Route::post('/library-admin/add/{bookId}', [BookController::class, 'addToLibraryAdmin'])->name('library.add-admin');
    Route::delete('/library-admin/remove/{bookId}', [BookController::class, 'removeFromLibraryAdmin'])->name('library.remove-admin');
});








