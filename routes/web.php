<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

//landing page
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
    return view('layouts.landing');
});

//method user & guest
Route::get('/libraries', function () {
    return view('content.libraries');
})->name('libraries');
Route::get('/recently', function () {
    return view('content.recently');
})->name('recently');
Route::get('/category', function () {
    return view('content.category');
})->name('category');
Route::get('/latest', function () {
    return view('content.latest');
})->name('latest');


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

Route::get('/home-admin', function () {
    return view('content-admin.home');
})->name('home-admin');

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
Route::get('/add-book', function () {
    return view('content-admin.add-book');
});

Route::get('/book/{book:slug}', [BookController::class, 'show']);



//test komen hehe -putmul

Route::middleware(['auth'])->group(function () {
    Route::get('content/home', [ProfileController::class, 'showUser'])->name('home');
    Route::get('/content-admin/home', [ProfileController::class, 'showAdmin'])->name('home-admin'); //return based role
});

//method show books

use App\Http\Controllers\BookController;

Route::get('/home', [BookController::class, 'home'])->name('home');


