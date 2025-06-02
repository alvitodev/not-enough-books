<?php

use Illuminate\Support\Facades\Route;


// Buat ngetes yakk
Route::get('/', function () {
    return view('content.landing');
});

//home page
Route::get('/home', function () {
    return view('content-admin.home');
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
Route::get('/login', function () {
    return view('user.login');
});
Route::get('/create', function () {
    return view('user.create');
});
Route::get('/editprofile', function () {
    return view('user.edit-profile');
});
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

Route::get('/book', function () {
    return view('content.book');
});



//test komen hehe -putmul
