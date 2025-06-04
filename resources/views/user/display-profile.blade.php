@extends('layouts.info')
@section('content')

  <body class="bg-cover bg-center min-h-screen font-sans" style="background-image: url('/img/background-library.jpg');">
    <div class="w-full flex justify-center px-4 py-10">
    <div class="w-full max-w-2xl backdrop-blur-md bg-white/90 rounded-2xl p-6 space-y-6 shadow-lg">

      <!-- Header -->
      <div class="flex items-center space-x-4  pb-4">
      <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('/images/default-avatar.png') }}"
        alt="Profile Picture" class="rounded-full w-16 h-16 object-cover">
      <div>
        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
        <p class="text-xs text-gray-500">@ {{ $user->username }}</p>
      </div>
      </div>

      <!-- Info -->
      <div class="space-y-4">
      <h3 class="text-lg font-semibold text-gray-700">Personal Information</h3>

      <div class="grid grid-cols-2 gap-4">
        <div>
        <p class="text-xs text-gray-500">Full Name</p>
        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
        </div>
        <div>
        <p class="text-xs text-gray-500">Username</p>
        <p class="text-sm font-medium text-gray-800">{{ $user->username }}</p>
        </div>
      </div>

      <div>
        <p class="text-xs text-gray-500">Email</p>
        <p class="text-sm font-medium text-gray-800 flex items-center">
        {{ $user->email }}
        </p>
      </div>

      <!-- Button -->
      <div class="flex justify-between items-center pt-4">
        @if (auth()->user()->is_admin)
      <a href="{{ route('home-admin') }}" class="btn btn-outline text-xs">Back to Home</a>
      @else
      <a href="{{ route('home') }}" class="btn btn-outline text-xs">Back to Home</a>
      @endif
        <a href="{{ route('edit-profile') }}" class="btn btn-emerald bg-emerald-500 text-white text-sm">Edit
        Profile</a>
      </div>
      </div>
    </div>
    </div>
  </body>
@endsection