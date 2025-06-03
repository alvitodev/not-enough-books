@extends('layouts.info')
@section('content')

<div class="bg-cover bg-center min-h-screen font-sans" style="background-image: url('/img/background-library.jpg');">
  <div class="w-full flex justify-center px-4 py-10">
    <!-- Form container diperluas -->
    <div class="w-full max-w-4xl backdrop-blur-md bg-white/90 rounded-2xl p-8 space-y-6">

      <!-- Header -->
      <div class="flex items-center space-x-6">
        <div class="relative">
          <img src="https://via.placeholder.com/100" alt="Profile Picture" class="rounded-full w-24 h-24 object-cover">
          <div class="mt-2">
            <label for="profilePic" class="cursor-pointer text-emerald-600 hover:underline text-xs font-medium">
              Change Picture
            </label>
            <input id="profilePic" type="file" class="hidden" />
          </div>
        </div>
        <div>
          <h2 class="text-2xl font-bold text-gray-800">{{ old('name', $user->name) }}</h2>
          <p class="text-xs text-gray-500">{{ old('username', $user->username) }}</p>
        </div>
      </div>

      <!-- Form -->
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
        @csrf
        @method('PUT') <!-- for RESTful update -->

        <!-- Name & Username -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block font-medium text-gray-600">First Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="First Name" class="input input-bordered w-full text-xs" />
          </div>
          <div>
            <label class="block font-medium text-gray-600">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Username" class="input input-bordered w-full text-xs" />
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="block font-medium text-gray-600">Email</label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="you@example.com" class="input input-bordered w-full text-xs" />
        </div>

        <!-- Password + Icon mata -->
        <div>
          <label class="block font-medium text-gray-600">Password</label>
          <div class="relative">
            <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full pr-10 text-xs" />
            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </span>
          </div>
        </div>

        <!-- Phone & DOB -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block font-medium text-gray-600">Phone</label>
            <input type="text" name="phone" placeholder="Phone Number" class="input input-bordered w-full text-xs" />
          </div>
          <div>
            <label class="block font-medium text-gray-600">Date of Birth</label>
            <input type="date" name="dob" class="input input-bordered w-full text-xs" />
          </div>
        </div>

        <!-- Location & Postal Code -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block font-medium text-gray-600">Location</label>
            <select name="location" class="select select-bordered w-full text-xs">
              <option>Atlanta, USA</option>
              <option>New York, USA</option>
              <option>Los Angeles, USA</option>
            </select>
          </div>
          <div>
            <label class="block font-medium text-gray-600">Postal Code</label>
            <input type="text" name="postal_code" placeholder="Postal Code" class="input input-bordered w-full text-xs" />
          </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4 mt-6">
          <a href="{{ route('profile') }}" class="btn btn-outline text-xs">Cancel</a>
          <button type="submit" class="btn bg-emerald-500 text-white hover:bg-emerald-600 text-xs">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
