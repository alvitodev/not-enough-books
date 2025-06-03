@extends('layouts.info')
@section('content')
<div class="min-h-screen flex items-center justify-center px-2 py-4 bg-cover bg-center" style="background-image: url('/images/library-bg.jpg')">
    <div class="w-full max-w-4xl backdrop-blur-md bg-white/90 rounded-xl p-6 space-y-4 text-sm">
        <h2 class="text-xl font-semibold text-center mb-1">Edit Book</h2>

        <form method="POST" action="{{ route('books.edit', $book->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-control mb-2">
                <label for="title" class="mb-1 block text-xs font-medium">Book Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" class="input input-bordered w-full text-xs" required>
            </div>

            <div class="form-control mb-2">
                <label for="author" class="mb-1 block text-xs font-medium">Author</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" class="input input-bordered w-full text-xs" required>
            </div>

            <div class="form-control mb-2">
                <label for="publisher" class="mb-1 block text-xs font-medium">Publisher</label>
                <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="input input-bordered w-full text-xs" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <div>
                    <label for="category" class="mb-1 block text-xs font-medium">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $book->category) }}" class="input input-bordered w-full text-xs" required>
                </div>
                <div>
                    <label for="year" class="mb-1 block text-xs font-medium">Year</label>
                    <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" class="input input-bordered w-full text-xs" required>
                </div>
            </div>

            <div class="form-control mb-2">
                <label for="description" class="mb-1 block text-xs font-medium">Description</label>
                <textarea id="description" name="description" rows="3" class="textarea textarea-bordered w-full text-xs">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="form-control mb-4">
                <label for="cover" class="mb-1 block text-xs font-medium">Book Cover (leave empty to keep current)</label>
                <input type="file" id="cover" name="cover" class="file-input file-input-xs file-input-bordered file-input-secondary w-full max-w-sm" accept="image/*">
            </div>

            <div class="flex">
                <button type="submit" class="btn btn-primary text-white w-full py-1.5">Update Book</button>
            </div>
        </form>
    </div>
</div>
@endsection
