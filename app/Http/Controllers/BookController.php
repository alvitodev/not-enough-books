<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Library;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $latestUpdatedBooksA = book::orderBy('year', 'desc')->paginate(4);
        return view('content-admin.latest', compact('latestUpdatedBooksA'));
    }

    public function recentAdmin() //show books at recently
    {
        $recentlyAddedBooksA = book::orderBy('id', 'desc')->paginate(4);
        return view('content-admin.recently', compact('recentlyAddedBooksA'));
    }

    public function showAdmin($id) //show books detail
    {
        $bookA = book::findOrFail($id); // fetch by ID, or 404 if not found
        return view('content-admin.book', compact('bookA'));
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

    public function destroy(Book $book) //delete books
    {
        $book->delete();

        return redirect()->route('home-admin')->with('success', 'Book deleted successfully!');
    }

    //method for user 

    public function home() //show books at home
    {
        // Example: get 4 latest books
        $recentBooks = book::orderBy('id', 'desc')->take(4)->get();
    
        // Example: get 4 recently added books (can be same as latest or customized)
        $latestBooks = book::orderBy('year', 'desc')->take(4)->get();
    
        return view('content.home', compact('latestBooks', 'recentBooks'));
    }

    public function latest() //show books at latest
    {
        $latestUpdatedBooks = book::orderBy('year', 'desc')->paginate(4);
        return view('content.latest', compact('latestUpdatedBooks'));
    }

    public function recent() //show books at recently
    {
        $recentlyAddedBooks = book::orderBy('id', 'desc')->paginate(4);
        return view('content.recently', compact('recentlyAddedBooks'));
    }

    public function show($id) //show books detail
    {
        $book = book::findOrFail($id); // fetch by ID, or 404 if not found
        return view('content.book', compact('book'));
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
