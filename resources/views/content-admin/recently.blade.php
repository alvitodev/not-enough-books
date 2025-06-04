@extends('layouts.admin')
@section('content')
  <div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
    <div class="flex justify-between items-center mb-8 ml-10">
    <h1 class="text-4xl font-bold text-white">Recently Addes</h1>
    </div>

    <!-- Latest Updates -->
    <div class="mb-0 ">
    <div class="flex flex-wrap gap-6 w-full">
      <div class="flex flex-wrap gap-6 justify-start w-full">
      @foreach ($recentlyAddedBooksA as $book)
      <div class="indicator">
      <span class="indicator-item indicator-start badge badge-white text-neutral mt-7 ml-14 rounded-md">i</span>
      <div class="card card-side w-270 h-40 bg-transparent">
      <div class="card card-side w-200 h-40 bg-transparent backdrop-blur-md ml-14 shadow-sm">
        <figure class="flex-shrink-0 w-1/6">
        <img src="{{ $book->cover_img ?? '/images/default-cover.jpg' }}" alt="Movie"
        class="w-full h-full object-cover rounded-xl" />
        </figure>
        <div class="card-body px-6 py-4">
        <div class="flex flex-col space-y-1">
        <a href="{{ route('books.show-admin', $book->id) }}"
        class="card-title text-lg text-white font-medium hover:text-base-300">{{ $book->title }}</a>
        <a href="#" class="text-white text-xs hover:text-base-300">{{ $book->author }}</a>
        <a class="text-primary text-[10px]">{{ $book->year }}</a>
        </div>
        <div class="card-actions justify-start mt-1">
        <button class="btn btn-xs btn-neutral text-white">{{ $book->category }}</button>
        <a href="{{ route('books.show-admin', $book->id) }}"
        class="btn btn-xs btn-success text-white">read</a>
        <form action="{{ route('library.add', $book->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-xs btn-warning text-white">Add Library</button>
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this book?');" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-xs btn-error text-white">Delete</button>
        </form>
        </div>
        </div>
      </div>
      </div>
      </div>
    @endforeach
      <div class="fixed bottom-8 left-[56%] -translate-x-1/2 z-50">
        <div class="join shadow-lg rounded-xl bg-white/80 backdrop-blur-md px-4 py-2 space-x-1">

        @if ($recentlyAddedBooksA->onFirstPage())
      <span class="join-item btn btn-xs rounded-md opacity-50 cursor-not-allowed">Prev</span>
      @else
      <a href="{{ $recentlyAddedBooksA->previousPageUrl() }}"
        class="join-item btn btn-xs rounded-md hover:bg-green-500 hover:text-white">Prev</a>
      @endif

        @for ($i = 1; $i <= $recentlyAddedBooksA->lastPage(); $i++)
      <a href="{{ $recentlyAddedBooksA->url($i) }}"
        class="join-item btn btn-xs rounded-md {{ $recentlyAddedBooksA->currentPage() == $i ? 'bg-green-500 text-white' : '' }}">
        {{ $i }}
      </a>
      @endfor

        @if ($recentlyAddedBooksA->hasMorePages())
      <a href="{{ $recentlyAddedBooksA->nextPageUrl() }}"
        class="join-item btn btn-xs rounded-md hover:bg-green-500 hover:text-white">Next</a>
      @else
      <span class="join-item btn btn-xs rounded-md opacity-50 cursor-not-allowed">Next</span>
      @endif

        </div>
      </div>
      </div>
    </div>
    </div>
  @endsection