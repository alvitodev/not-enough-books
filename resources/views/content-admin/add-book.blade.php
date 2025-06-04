@extends('layouts.info')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center px-2 py-4"
        style="background-image: url('/images/library-bg.jpg')">
        <div class="w-full max-w-4xl backdrop-blur-md bg-white/90 rounded-xl p-6 space-y-4 text-sm">
            <h2 class="text-xl font-semibold text-center mb-1">Add Book</h2>
            <p class="text-xs text-center mb-4">Let's Add book you choose</p>

            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Display All Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-error shadow-lg mb-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2 2m2-2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Please correct the errors below:</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Title -->
                <div class="form-control mb-2">
                    <label for="title" class="mb-1 block text-xs font-medium">Book Title</label>
                    <input type="text" id="title" name="title"
                        class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('title') input-error @enderror"
                        placeholder="Enter book title" value="{{ old('title') }}" required />
                    @error('title')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Author -->
                <div class="form-control mb-2">
                    <label for="author" class="mb-1 block text-xs font-medium">Author</label>
                    <input type="text" id="author" name="author"
                        class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('author') input-error @enderror"
                        placeholder="Enter author name" value="{{ old('author') }}" required />
                    @error('author')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- publisher -->
                <div class="form-control mb-2">
                    <label for="publisher" class="mb-1 block text-xs font-medium">Publisher</label>
                    <input type="text" id="publisher" name="publisher"
                        class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('publisher') input-error @enderror"
                        placeholder="Enter publisher name" value="{{ old('publisher') }}" required />
                    @error('publisher')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category & Year -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                    <div>
                        <label for="category" class="mb-1 block text-xs font-medium">Category</label>
                        <input type="text" id="category" name="category"
                            class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('category') input-error @enderror"
                            placeholder="Choose category" value="{{ old('category') }}" required />
                        @error('category')
                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="year" class="mb-1 block text-xs font-medium">Year</label>
                        <input type="number" id="year" name="year"
                            class="input input-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('year') input-error @enderror"
                            placeholder="Enter year" value="{{ old('year') }}" required />
                        @error('year')
                            <span class="text-error text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-control mb-2">
                    <label for="description" class="mb-1 block text-xs font-medium">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="textarea textarea-bordered w-full text-xs placeholder-gray-400 py-1 px-2 @error('description') textarea-error @enderror"
                        placeholder="Enter description book">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload Cover -->
                <div class="form-control mb-4">
                    <label for="cover_img" class="mb-1 block text-xs font-medium">Book Cover</label>
                    <input type="file" id="cover_img" name="cover_img"
                        class="file-input file-input-xs file-input-bordered file-input-secondary w-full max-w-sm @error('cover_img') file-input-error @enderror"
                        accept="image/*" />
                    @error('cover_img')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Save Button -->
                <div class="flex">
                    <button type="submit" class="btn btn-primary hover:bg-green-500 text-white text-sm w-full py-1.5">Add
                        book</button>
                </div>
            </form>
        </div>
    </div>
@endsection