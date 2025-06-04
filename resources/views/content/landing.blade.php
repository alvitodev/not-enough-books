@extends('layouts.primary')

@section('content')
  <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center px-4 py-12"
    style="background-image: url('/images/bg-primary.png');">
    <div class="text-center backdrop-blur-md bg-white/80 p-10 rounded-xl shadow-2xl">
    <h1 class="text-5xl font-bold text-gray-800 mb-6">
      Welcome to NotEnoughBooks!
    </h1>
    <p class="text-lg text-gray-700 mb-8">
      Discover your next favorite read. Explore our vast collection of books across all genres.
    </p>
    <a href="{{ route('home') }}"
      class="btn btn-primary btn-lg hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
      Getting Started
    </a>
    </div>

    <div class="mt-12 text-center">
    <p class="text-sm text-white/90">
      &copy; {{ date('Y') }} NotEnoughBooks. All rights reserved.
    </p>
    </div>
  </div>
@endsection