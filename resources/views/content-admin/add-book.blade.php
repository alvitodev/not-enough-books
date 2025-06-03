@extends('layouts.info')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center px-2 py-4" style="background-image: url('/images/library-bg.jpg')">
    <div class="w-full max-w-4xl backdrop-blur-md bg-white/90 rounded-xl p-6 space-y-4 text-sm">
        <h2 class="text-xl font-semibold text-center mb-1">Add Book</h2>
        <p class="text-xs text-center mb-4">Let's Add book you choose</p>

        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-control mb-2">
                <label for="title" class="mb-1 block text-xs font-medium">Book Title</label>
                <input type="text" id="title" name="title" class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2" placeholder="Enter book title" value="" required />
            </div>

            <!-- Author -->
            <div class="form-control mb-2">
                <label for="author" class="mb-1 block text-xs font-medium">Author</label>
                <input type="text" id="author" name="author" class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2" placeholder="Enter author name" value="" required />
            </div>

            <!-- Category & Year -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                <div>
                    <label for="category" class="mb-1 block text-xs font-medium">Category</label>
                    <input type="text" id="category" name="category" class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2" placeholder="Choose category" value="" required />
                </div>
                <div>
                    <label for="year" class="mb-1 block text-xs font-medium">Year</label>
                    <input type="number" id="year" name="year" class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2" placeholder="Enter year" value="" required />
                </div>
            </div>

            <!-- Description -->
            <div class="form-control mb-2">
                <label for="description" class="mb-1 block text-xs font-medium">Description</label>
                <textarea id="description" name="description" rows="3" class="textarea textarea-bordered w-full text-xs placeholder-gray-400 py-1 px-2" placeholder="Enter description book"></textarea>
            </div>

            <!-- Upload Cover -->
            <div class="form-control mb-4">
                <label for="cover" class="mb-1 block text-xs font-medium">Book Cover</label>
                <input type="file" id="cover" name="cover" class="file-input file-input-xs file-input-bordered file-input-secondary w-full max-w-sm" accept="image/*" />
            </div>

            <!-- Save Button -->
            <div class="flex">
                <button type="submit" class="btn btn-primary hover:bg-green-500 text-white text-sm w-full py-1.5">Add book</button>
            </div>
        </form>

    </div>
</div>
@endsection
