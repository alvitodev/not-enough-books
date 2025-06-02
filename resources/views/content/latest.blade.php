@extends('layouts.primary')
@section('content')
<div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
  <div class="flex justify-between items-center mb-8 ml-10">
    <h1 class="text-4xl font-bold text-white">Latest Update</h1>
  </div>
<div class="flex items-center gap-0 overflow-hidden rounded-full bg-white w-1/2 h-9 mb-12 ml-10 shadow-lg">
    <!-- Category Select -->
    <select class="select rounded-none rounded-l-full bg-white text-neutral border-none w-40 focus:outline-none focus:ring-0">
        <option selected>All Category</option>
        <option>Science</option>
        <option>Fiction</option>
        <option>History</option>
    </select>
    <a class="text-base-200 text-lg mr-4 ">|</a>
    <a href="" class="text-neutral text-sm mr-4">Psychology</a>
    <a class="text-base-200 text-lg mr-4 ">|</a>
    <a href="" class="text-neutral text-sm mr-4">Technology</a>
    <a class="text-base-200 text-lg mr-4 ">|</a>
    <a href="" class="text-neutral text-sm mr-4">Education</a>
     <a class="text-base-200 text-lg mr-4 ">|</a>
    <a href="" class="text-neutral text-sm mr-4">Enginering</a>
    </div>

  <!-- Latest Updates -->
<div class="mb-0 ">
  <div class="flex flex-wrap gap-6 w-full">
    <div class="flex flex-wrap gap-6 justify-start w-full">
    @for ($i = 0; $i < 4; $i++)
<div class="indicator">
  <span class="indicator-item indicator-start badge badge-white text-neutral mt-7 ml-14 rounded-md">i</span>
    <div class="card card-side w-270 h-40 bg-transparent">
  <div class="card card-side w-200 h-40 bg-transparent backdrop-blur-md ml-14 shadow-sm">
        <figure class="flex-shrink-0 w-1/6">
          <img
            src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
            alt="Movie"
            class="w-full h-full object-cover rounded-xl" />
        </figure>
        <div class="card-body px-6 py-4">
          <div class="flex flex-col space-y-1">
          <a href="#" class="card-title text-lg text-white font-medium hover:text-base-300"> Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones</a>
          <a href="#" class="text-white text-xs hover:text-base-300">Author123</a>
          <a class="text-primary text-[10px]">2 minutes ago</a>
          </div>
          <div class="card-actions justify-start mt-1">
            <button class="btn btn-xs btn-neutral text-white">Category</button>
            <button class="btn btn-xs btn-success text-white">read</button>
            <button class="btn btn-xs btn-warning text-white">Add Library</button>
          </div>
        </div>
        </div>
      </div>
    </div>
    @endfor
</div>
  </div>
</div>
@endsection