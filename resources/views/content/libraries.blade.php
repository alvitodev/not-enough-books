@extends('layouts.primary')
@section('content')
<div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
  <div class="flex justify-between items-center mb-8 ml-10">
    <h1 class="text-4xl font-bold text-white">Libraries</h1>
  </div>

  <!-- Latest Updates -->
<div class="mb-10 ">
  <div class="flex flex-wrap gap-6">
    <!-- Masksimal 4 buku -->
    @forelse ($libraryBooks as $item)
    <div class="indicator">
  <span class="indicator-item indicator-start badge badge-white text-neutral mt-7 ml-14 rounded-md">i</span>
    <div class="card card-side w-200 h-40 bg-transparent backdrop-blur-md ml-14 shadow-sm">
        <figure class="flex-shrink-0 w-1/6">
          <img
            src="{{ $item->book->cover_img ?? 'https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp' }}"
            alt="Movie"
            class="w-full h-full object-cover rounded-xl" />
        </figure>
        <div class="card-body px-6 py-4">
          <div class="flex flex-col space-y-1">
          <a href="#" class="card-title text-lg text-white font-medium hover:text-base-300">{{ $item->book->title }}</a>
          <a href="#" class="text-white text-xs hover:text-base-300">{{ $item->book->author }}</a>
          <a class="text-primary text-[10px]">{{ $item->book->year }}</a>
          </div>
          <div class="card-actions justify-start mt-1">
            <button class="btn btn-xs btn-neutral text-white">{{ $item->book->category }}</button>
            <a href="{{ route('books.show', $item->book->id) }}" class="btn btn-xs btn-success text-white">Read</a>
            <form action="{{ route('library.remove', $item->book->id) }}" method="POST" onsubmit="return confirm('Remove this book from your library?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-xs btn-error text-white">remove</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @empty
      <p class="text-white ml-14">Your library is empty.</p>
    @endforelse
  </div>
</div>
@endsection