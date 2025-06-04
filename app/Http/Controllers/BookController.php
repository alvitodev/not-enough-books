<?php

namespace App\Http\Controllers;

use App\Models\Books; // Menggunakan model Books
use App\Models\User;   // Jika masih dipakai untuk filter author
use App\Models\Category; // Jika masih dipakai untuk filter category
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource for the home page.
     */
    public function home() // Method untuk route('home')
    {
        // Anda bisa menambahkan filter atau paginasi di sini jika diperlukan
        $latestBooks = Books::latest()->take(8)->get(); // Ambil 8 buku terbaru sebagai contoh
        $recentBooks = Books::orderBy('created_at', 'desc')->take(4)->get(); // Contoh untuk recent books

        // Cek apakah file view ada sebelum me-return
        // Jika view `content.home` adalah untuk admin, pastikan itu benar.
        // Jika `content.home` adalah untuk user, maka kirim data yang sesuai.
        return view('content.home', [
            'books' => $latestBooks, // Untuk section "Latest Updates"
            'recentBooks' => $recentBooks // Untuk section "Recently Added"
            // Kirim variabel lain yang dibutuhkan oleh view content.home
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book) // Menggunakan model Books untuk route model binding
    {
        return view('content.book', [ // View untuk menampilkan detail satu buku
            "title" => $book->title, // Judul halaman bisa dari judul buku
            "book" => $book
        ]);
    }

    /**
     * Show the form for creating a new resource (Admin).
     * Ini akan dipanggil oleh rute GET admin/books/add
     */
    public function create()
    {
        // Anda mungkin perlu mengirim data kategori ke view
        // $categories = Category::all();
        // return view('content-admin.add-book', compact('categories'));
        return view('content-admin.add-book');
    }

    /**
     * Store a newly created resource in storage (Admin).
     * Ini akan dipanggil oleh rute POST admin/books
     */
    public function store(Request $request)
    {
        // Validasi data dari form add-book.blade.php
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255', // Jika author hanya string
            // 'author_id' => 'required|exists:authors,id', // Jika author adalah relasi
            'category_id' => 'required|exists:categories,id', // Pastikan ada category_id dari form
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'publisher' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Contoh validasi gambar
            'slug' => 'required|string|unique:books,slug' // Slug bisa di-generate otomatis
        ]);

        // Handle file upload untuk cover_img
        if ($request->hasFile('cover_img')) {
            $path = $request->file('cover_img')->store('book_covers', 'public'); // Simpan di storage/app/public/book_covers
            $validatedData['cover_img'] = $path;
        }

        // Jika slug tidak diisi manual, bisa di-generate dari title
        // $validatedData['slug'] = \Illuminate\Support\Str::slug($request->title);
        // Atau biarkan EloquentSluggable yang handle jika sudah disetup dengan benar.

        Books::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Book added successfully!'); // Redirect ke dashboard admin
    }

    /**
     * Show the form for editing the specified resource (Admin).
     * Ini akan dipanggil oleh rute GET admin/books/{book}/edit
     */
    public function edit(Books $book)
    {
        // $categories = Category::all();
        // return view('content-admin.edit-book', compact('book', 'categories'));
        return view('content-admin.edit-book', compact('book'));
    }

    /**
     * Update the specified resource in storage (Admin).
     * Ini akan dipanggil oleh rute PUT/PATCH admin/books/{book}
     */
    public function update(Request $request, Books $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
            'publisher' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             // Slug unik, kecuali untuk buku ini sendiri
            'slug' => 'required|string|unique:books,slug,' . $book->id
        ]);

        if ($request->hasFile('cover_img')) {
            // Hapus gambar lama jika ada dan jika perlu
            // if ($book->cover_img) {
            //     Storage::disk('public')->delete($book->cover_img);
            // }
            $path = $request->file('cover_img')->store('book_covers', 'public');
            $validatedData['cover_img'] = $path;
        }

        // Jika slug tidak diisi manual dan title berubah, regenerate
        // if ($request->title !== $book->title && empty($request->slug)) {
        //    $validatedData['slug'] = \Illuminate\Support\Str::slug($request->title);
        // }

        $book->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage (Admin).
     * Ini akan dipanggil oleh rute DELETE admin/books/{book}
     */
    public function destroy(Books $book)
    {
        // Hapus gambar jika ada
        // if ($book->cover_img) {
        //     Storage::disk('public')->delete($book->cover_img);
        // }
        $book->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Book deleted successfully!');
    }


    // Method index() yang lama sepertinya tidak terpakai di rute,
    // jika masih dibutuhkan, pastikan ada rute yang mengarah ke sini.
    // public function index() {
    //     $title = '';
    //     if(request('category')) {
    //         $category = Category::firstWhere('slug', request('category'));
    //         $title = ' dalam ' . $category->name;
    //     }
    //     if(request('author')) {
    //         // Asumsi author adalah relasi ke User model, atau sesuaikan jika ke Author model
    //         $author = User::firstWhere('username', request('author'));
    //         $title = ' oleh ' . $author->name;
    //     }
    //     return view('books.index', [ // Ganti 'book' menjadi 'books.index' atau nama view yang sesuai
    //         "title" => "All Books" . $title,
    //         "active" => 'books',
    //         "books" => Books::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
    //     ]);
    // }
}