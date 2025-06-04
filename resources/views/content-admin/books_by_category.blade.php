@extends('layouts.admin')
@section('content')
  <div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
    <div class="flex justify-between items-center mb-8 ml-10">
    <h1 class="text-4xl font-bold text-white">Category: {{ $category }}</h1>
    </div>


    <!-- Books List -->
    <div class="mb-10">
    <div class="flex flex-wrap gap-6">
      @forelse ($booksA as $book)
      <div class="indicator">
      <span class="indicator-item indicator-start badge badge-white text-neutral mt-7 ml-14 rounded-md">i</span>
      <div class="card card-side w-200 h-40 bg-transparent backdrop-blur-md ml-14 shadow-sm">
      <figure class="flex-shrink-0 w-1/6">
      <img
        src="{{ $book->cover_img ?? 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp' }}"
        alt="{{ $book->title }}" class="w-full h-full object-cover rounded-xl" />
      </figure>
      <div class="card-body px-6 py-4">
      <div class="flex flex-col space-y-1">
        <a href="{{ route('books.show-admin', $book->id) }}"
        class="card-title text-lg text-white font-medium hover:text-base-300">
        {{ $book->title }}
        </a>
        <a href="#" class="text-white text-xs hover:text-base-300">
        {{ $book->author ?? 'Unknown Author' }}
        </a>
        <a class="text-primary text-[10px]">
        {{ $book->year}}
        </a>
      </div>
      <div class="card-actions justify-start mt-1">
        <button class="btn btn-xs btn-neutral text-white">{{ $book->category }}</button>
        <a href="{{ route('books.show-admin', $book->id) }}" class="btn btn-xs btn-success text-white">Read</a>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this book?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-xs btn-error text-white">Delete</button>
        </form>
      </div>
      </div>
      </div>
      </div>
    @empty
      <p class="text-white ml-14">No books found in this category.</p>
    @endforelse
    </div>
    </div>
  @endsection