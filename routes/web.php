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

Route::get('/category', function () {
    return view('content.category');
})->name('category');

Route::get('/latest', function () {
    return view('content.latest');
})->name('latest');

Route::get('/search', function () { // Anda mungkin ingin ini juga ke controller
    // Logika pencarian bisa ditambahkan di sini atau di controller
    $query = request('q'); // Contoh mengambil query pencarian
    // $results = Books::where('title', 'like', '%'.$query.'%')->get();
    return view('content.search' /*, compact('results', 'query')*/);
})->name('search'); // Memberikan nama pada rute search

// Menampilkan detail buku
Route::get('/book/{book:slug}', [BookController::class, 'show'])->name('book.show');


// --- Rute Autentikasi ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login'); // Asumsi ada method showLoginForm
    Route::post('/login', [AuthLoginController::class, 'store']); // Menggunakan store dari AuthLoginController

    Route::get('/register', [AuthRegisterController::class, 'showRegistrationForm'])->name('register'); // Asumsi ada method showRegistrationForm
    Route::post('/register', [AuthRegisterController::class, 'store']); // Menggunakan store dari AuthRegisterController
});

Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout')->middleware('auth');


// --- Rute Pengguna yang Terautentikasi ---
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/user/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/user/update-profile', [ProfileController::class, 'update'])->name('profile.update'); // Menggunakan PUT untuk update

    // Fitur user lain jika ada (misal wishlist, dll)
});


// --- Rute Admin ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () { // Menggunakan prefix dan name group untuk admin
    Route::get('/dashboard', function () { // Contoh dashboard admin
        return view('content-admin.home'); // Atau ke controller khusus admin
    })->name('dashboard'); // admin.dashboard

    Route::get('/books/add', function () { // URI yang lebih baik
        return view('content-admin.add-book');
    })->name('books.add'); // admin.books.add

    // Untuk menyimpan buku baru (method POST)
    // Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');

    Route::get('/books/{book}/edit', function (Books $book) { // Menggunakan route model binding jika memungkinkan
        return view('content-admin.edit-book', compact('book'));
    })->name('books.edit'); // admin.books.edit

    // Untuk update buku (method PUT/PATCH)
    // Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('books.update');

    Route::get('/latest', function () {
        return view('content-admin.latest');
    })->name('latest'); // admin.latest

    Route::get('/recently', function () {
        return view('content-admin.recently');
    })->name('recently'); // admin.recently

    Route::get('/libraries', function () {
        return view('content-admin.libraries');
    })->name('libraries'); // admin.libraries

    Route::get('/category', function () { // Sebaiknya ke controller
        return view('content-admin.category');
    })->name('category'); // admin.category

    // Tambahkan rute admin lainnya di sini
});


// Hapus rute yang sudah dicover atau duplikat di bawah ini:
// Route::get('/editprofile', [ProfileController::class, 'index']); // Sudah ada profile.edit
// Route::get('/profile', function () { return view('user.edit-profile'); }); // Sudah ada
// Route::get('/admin', function () { return view('layouts.admin'); }); // Sebaiknya ke rute dashboard admin
// Route::get('/home-admin', function () { return view('content-admin.home'); })->name('home-admin'); // Sudah ada admin.dashboard

// Route::get('/create', function () { return view('user.create'); })->name('create'); // Sudah ada register

// Bagian ini sudah tercakup oleh middleware('auth', 'admin') di atas jika peran admin benar diimplementasikan
// Route::middleware(['auth'])->group(function () {
//     // Route::get('content/home', [ProfileController::class, 'showUser'])->name('home'); // Rute home utama sudah ada di atas
//     // Route::get('/content-admin/home', [ProfileController::class, 'showAdmin'])->name('home-admin'); // Sudah ada admin.dashboard
// });

// Catatan: Tidak ada lagi kurung kurawal `}` di akhir file ini.