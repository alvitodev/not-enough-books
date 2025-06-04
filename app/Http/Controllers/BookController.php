<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //admin 

    public function homeAdmin() //show books at home
    {
        // Example: get 4 latest books
        $recentBooksA = book::orderBy('id', 'desc')->take(4)->get();

        // Example: get 4 recently added books (can be same as latest or customized)
        $latestBooksA = book::orderBy('year', 'desc')->take(4)->get();

        return view('content-admin.home', compact('latestBooksA', 'recentBooksA'));
    }

    public function latestAdmin() //show books at latest
    {
        $categoriesA = Book::select('category')->distinct()->orderBy('category')->get();
        $selectedCategory = request()->query('category');

        $latestUpdatedBooksQuery = book::orderBy('year', 'desc');

        if ($selectedCategory) {
            $latestUpdatedBooksQuery->where('category', $selectedCategory);
        }

        $latestUpdatedBooksA = $latestUpdatedBooksQuery->paginate(4)->withQueryString();

        return view('content-admin.latest', compact('latestUpdatedBooksA', 'categoriesA', 'selectedCategory'));
    }

    public function recentAdmin() //show books at recently
    {
        $categoriesA = Book::select('category')->distinct()->orderBy('category')->get();
        $selectedCategory = request()->query('category');

        $recentlyAddedBooksQuery = book::orderBy('id', 'desc');

        if ($selectedCategory) {
            $recentlyAddedBooksQuery->where('category', $selectedCategory);
        }

        $recentlyAddedBooksA = $recentlyAddedBooksQuery->paginate(4)->withQueryString();
        return view('content-admin.recently', compact('recentlyAddedBooksA', 'categoriesA', 'selectedCategory'));
    }

    public function showAdmin($id) //show books detail
    {
        $book = book::findOrFail($id);

        // Recommend 4 books from the same category (excluding the current one)
        $recommendedBooksA = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(4)
            ->get();

        return view('content-admin.book', compact('book', 'recommendedBooksA'));
    }

    public function showCategoryAdmin()
    {
        // Get unique categories from the books table
        $categoriesA = book::select('category')
            ->distinct()
            ->orderBy('category')
            ->get();

        return view('content-admin.category', compact('categoriesA'));
    }

    public function showBooksByCategoryAdmin($category)
    {
        $booksA = book::where('category', $category)->latest()->paginate(8);
        return view('content-admin.books_by_category', compact('booksA', 'category'));
    }

    public function addToLibraryAdmin($bookId)
    {
        $userId = Auth::id();

        // Check if the book is already in user's library
        $exists = Library::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if (!$exists) {
            Library::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);
        }

        return redirect()->back()->with('success', 'Book added to your library.');
    }

    public function userLibraryAdmin() //show the books in library
    {
        $userId = Auth::id();
        $libraryBooksA = Library::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('content-admin.libraries', compact('libraryBooksA'));
    }

    public function removeFromLibraryAdmin($bookId)
    {
        $userId = Auth::id();

        Library::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->delete();

        return redirect()->back()->with('success', 'Book removed from your library.');
    }

    public function recommendAdmin($id)
    {
        $book = Book::findOrFail($id);

        // Recommend 4 books from the same category (excluding the current one)
        $recommendedBooksA = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(4)
            ->get();

        return view('content-admin.book', compact('book', 'recommendedBooksA'));
    }

    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $books = Book::query();

        if ($query) {
            $books->where('title', 'like', "%{$query}%")
                ->orWhere('author', 'like', "%{$query}%");
        }

        if ($category) {
            $books->where('category', $category);
        }

        $booksSA = $books->latest()->get();

        return view('content-admin.search', compact('booksSA'));
    }

    public function store(Request $request) ///add books
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:2025',
            'description' => 'nullable|string',
            'cover_img' => 'nullable|image|max:2048',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('cover_img')) {
            $coverPath = $request->file('cover_img')->store('covers', 'public');
            $validated['cover_img'] = $coverPath;
        }

        Book::create($validated);

        return redirect()->route('home-admin')->with('success', 'Book added successfully!');
    }

    public function edit(Book $book) // Show the form for editing the specified book.
    {
        return view('content-admin.edit-book', compact('book'));
    }

    public function update(Request $request, Book $book) // Update the specified book in storage.
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:2025',
            'description' => 'nullable|string',
            'cover_img' => 'nullable|image|max:2048', // Max 2MB
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('cover_img')) {
            // Delete old cover if it exists and is not an external URL or a public path
            if (
                $book->cover_img &&
                !Str::startsWith($book->cover_img, ['http://', 'https://']) &&
                !Str::startsWith($book->cover_img, '/')
            ) {
                Storage::disk('public')->delete($book->cover_img);
            }
            // Store new cover
            $coverPath = $request->file('cover_img')->store('covers', 'public');
            $validated['cover_img'] = $coverPath;
        } else {
            // Keep the old cover if no new image is uploaded
            $validated['cover_img'] = $book->cover_img;
        }

        $book->update($validated);

        return redirect()->back()->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book) //delete books
    {
        $book->delete();

        return redirect()->route('home-admin')->with('success', 'Book deleted successfully!');
    }

    //method for user 

    public function landingPage() // Show the landing page
    {
        return view('content.landing');
    }

    public function home() //show books at home
    {
        // Example: get 4 latest books
        $recentBooks = book::orderBy('id', 'desc')->take(4)->get();

        // Example: get 4 recently added books (can be same as latest or customized)
        $latestBooks = book::orderBy('year', 'desc')->take(4)->get();

        return view('content.home', compact('latestBooks', 'recentBooks'));
    }

    public function latest(Request $request) //show books at latest
    {
        $categories = Book::select('category')->distinct()->orderBy('category')->get();
        $selectedCategory = $request->query('category');

        $latestUpdatedBooksQuery = book::orderBy('year', 'desc');

        if ($selectedCategory) {
            $latestUpdatedBooksQuery->where('category', $selectedCategory);
        }

        $latestUpdatedBooks = $latestUpdatedBooksQuery->paginate(4)->withQueryString(); // Added withQueryString() to preserve category filter during pagination

        return view('content.latest', compact('latestUpdatedBooks', 'categories', 'selectedCategory'));
    }

    public function recent(Request $request) //show books at recently
    {
        $categories = Book::select('category')->distinct()->orderBy('category')->get();
        $selectedCategory = $request->query('category');

        $recentlyAddedBooksQuery = book::orderBy('id', 'desc');

        if ($selectedCategory) {
            $recentlyAddedBooksQuery->where('category', $selectedCategory);
        }

        $recentlyAddedBooks = $recentlyAddedBooksQuery->paginate(4)->withQueryString(); // Added withQueryString() to preserve category filter during pagination

        return view('content.recently', compact('recentlyAddedBooks', 'categories', 'selectedCategory'));
    }

    public function show($id) //show books detail
    {
        $book = book::findOrFail($id); // fetch by ID, or 404 if not found

        // Recommend 4 books from the same category (excluding the current one)
        $recommendedBooks = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(4)
            ->get();

        return view('content.book', compact('book', 'recommendedBooks'));
    }

    public function showCategory()
    {
        // Get unique categories from the books table
        $categories = book::select('category')
            ->distinct()
            ->orderBy('category')
            ->get();

        return view('content.category', compact('categories'));
    }

    public function showBooksByCategory($category)
    {
        $books = book::where('category', $category)->latest()->paginate(8);
        return view('content.books_by_category', compact('books', 'category'));
    }

    public function recommend($id)
    {
        $book = Book::findOrFail($id);

        // Recommend 4 books from the same category (excluding the current one)
        $recommendedBooks = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(4)
            ->get();

        return view('content.book', compact('book', 'recommendedBooks'));
    }

    public function addToLibrary($bookId)
    {
        $userId = Auth::id();

        // Check if the book is already in user's library
        $exists = Library::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if (!$exists) {
            Library::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);
        }

        return redirect()->back()->with('success', 'Book added to your library.');
    }

    public function userLibrary() //show the books in library
    {
        $userId = Auth::id();
        $libraryBooks = Library::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('content.libraries', compact('libraryBooks'));
    }

    public function removeFromLibrary($bookId)
    {
        $userId = Auth::id();

        Library::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->delete();

        return redirect()->back()->with('success', 'Book removed from your library.');
    }

    public function search(Request $request)
    {
        $query = $request->input('queryU');
        $category = $request->input('category');

        $books = Book::query();

        if ($query) {
            $books->where('title', 'like', "%{$query}%")
                ->orWhere('author', 'like', "%{$query}%");
        }

        if ($category) {
            $books->where('category', $category);
        }

        $booksS = $books->latest()->get();

        return view('content.search', compact('booksS'));
    }

}
