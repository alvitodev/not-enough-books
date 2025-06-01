@extends('layouts.primary')
@section('content')
<div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
  <div class="flex justify-between items-center mb-8 ml-3">
    <h1 class="text-4xl font-bold text-white">Libraries</h1>
  </div>

  <!-- Latest Updates -->
<div class="mb-10 ">
  <div class="flex flex-wrap gap-6">
    <!-- Masksimal 4 buku -->
    @for ($i = 0; $i < 4; $i++)
      <div class="card card-side w-full sm:w-[240px] bg-transparent backdrop-blur-md ml-3 shadow-sm">
        <figure class="flex-shrink-0 w-1/2">
          <img
            src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
            alt="Movie"
            class="w-full h-full object-cover rounded-xl" />
        </figure>
        <div class="card-body px-3 py-2">
          <span class="card-title text-xs text-white font-medium">New movie is released!</span>
          <span class="text-white text-[10px]">Author123</span>
          <span class="text-primary text-[10px]">2 minutes ago</span>
          <div class="card-actions justify-start mt-1">
            <button class="btn btn-xs btn-success text-white">read</button>
          </div>
        </div>
      </div>
    @endfor
  </div>
</div>
@endsection