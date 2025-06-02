@extends('layouts.admin')
@section('content')
<div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
  <div class="flex justify-between items-center mb-8 ml-10">
    <h1 class="text-4xl font-bold text-white">Category</h1>
  </div>

<div class="mb-0 ">
  <div class="flex flex-wrap gap-6 ml-15">
    @for ($i = 0; $i < 16; $i++)
      <div class="card bg-transparent w-55 rounded-xl shadow-sm relative overflow-hidden">
        <figure href="#" class="rounded-xl overflow-hidden">
          <img
            src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
            alt="Shoes"
            class="rounded-xl" />
        </figure>
       <div class="absolute bottom-4 left-4 z-10">
        <a href="#" class="text-2xl font-bold text-white px-3 py-2 hover:text-base-300 rounded">Category</a>
      </div>
      </div>
    @endfor
  </div>
</div>
@endsection