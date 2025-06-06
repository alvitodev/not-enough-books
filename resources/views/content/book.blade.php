<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @vite('resources/css/app.css')
    </head>
    <body>
<!-- NAVBAR START -->
        <div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent shadow-none">
            <div class="navbar-start"></div>
            <div class="navbar-end flex items-center gap-4">

    @guest
      {{-- Navbar untuk Guest --}}
            <div class="flex items-center">
              <label class="flex items-center gap-2 px-2 py-1 h-7 rounded-full bg-white w-90 max-w-xs">
                <svg class="w-3 h-3 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input
                    type="search"
                    class="grow text-[10px] placeholder:text-[11px] leading-none bg-transparent focus:outline-none"
                    placeholder="Search the book you like..." />
            </label>
            </div>
        
        <div class="flex items-center">
        <a href="{{ route('login') }}" class="btn btn-ghost btn-sm flex items-center gap-2 cursor-pointer">
          <div class="avatar">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
          </svg>
          </div>
          <span class="text-xs text-white font-semibold">Sign in</span>
        </a>
        </div>

        @else
          {{-- Navbar untuk User --}}
           <div class="flex items-center">
              <label class="flex items-center gap-2 px-2 py-1 h-7 rounded-full bg-white w-90 max-w-xs">
                <svg class="w-3 h-3 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input
                    type="search"
                    class="grow text-[10px] placeholder:text-[11px] leading-none bg-transparent focus:outline-none"
                    placeholder="Search the book you like..." />
            </label>
            </div>
        
        <div class="flex items-center">
        <a href="{{ route('profile') }}" class="btn btn-ghost btn-sm flex items-center gap-2 cursor-pointer">
          <div class="avatar">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
          </svg>
          </div>
          <span class="text-xs text-white font-semibold">{{ Auth::user()->username ?? Auth::user()->name }}</span>
        </a>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-xs text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 rounded-box mt-3 w-35 p-2 shadow z-[1]">
            <li>
                <a href="{{ route('profile') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>   
                <span class="text-[10] ml-1">profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="flex items-center gap-1 text-[10px] ml-1 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                      <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                    </svg>  
                    <span class="text-[10] ml-1">Sign out</span>
                  </button>
                </form>
            </li>
            </ul>
        </div>
        @endguest
      </div>
    </div>
  </div>
<!-- Navbar End -->


<!-- Sidebar Start -->
<div class="drawer lg:drawer-open bg-white">
<input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
  <div class="drawer-content flex flex-col items-center justify-center">
  <div class="hero min-h-screen" style="background-image: url('/images/bg-primary.png');">
<div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">

<div class="mt-10">
  <div class="flex justify-center">
    <div class="card w-full max-w-6xl bg-transparent backdrop-blur-md bg-base-100/30 border border-white/10 shadow-md rounded-xl overflow-hidden">
      <div class="grid grid-cols-1 md:grid-cols-4">
        <!-- Cover Image -->
        <figure class="md:col-span-1">
          <img src="{{ $book->cover_img ?? '/images/default-cover.jpg' }}"
               alt="Book Cover"
               class="w-full h-full object-cover rounded-l-xl md:rounded-xl md:rounded-r-none" />
        </figure>

        <!-- Content -->
        <div class="md:col-span-3 ml-6 mr-4 space-y-4 text-white max-h-90 overflow-y-auto pr-2">

          <!-- Judul -->
          <h2 class="text-xl font-bold mt-5">
            {{ $book->title }}
          </h2>
          
          <!-- Author -->
          <p class="text-sm opacity-80">Author: <span class="font-medium">{{ $book->author }}</span></p>

          <!-- Deskripsi -->
          <p class="text-xs opacity-90 leading-relaxed">
          {{ $book->description }}
          </p>

          <!-- Info Buku -->
          <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-xs">
            <p><span class="font-semibold">Categories:</span> {{ $book->category }}</p>
            <p><span class="font-semibold">Publisher:</span> {{ $book->publisher }}</p>
            <p><span class="font-semibold">Publish Year:</span> {{ $book->year }}</p>
            <p><span class="font-semibold">Language:</span> English</p>
            <p><span class="font-semibold">Content Type:</span> Book</p>
          </div>

          <!-- Aksi -->
          <div class="flex flex-wrap gap-2 pt-2">
            <form action="{{ route('library.add', $book->id) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-sm btn-neutral text-white">Add to Library</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<div class="mb-10 mt-10 w-full max-w-none">
  <div class="flex justify-between items-center mb-5 ">
    <a href="#" class="text-2xl text-white font-semibold px-8 block">You may be interest</a>
    </div>
      <div class="flex flex-wrap gap-6 justify-start w-full">
      @foreach ($recommendedBooks as $recommended)
        <div class="card card-side min-w-[220px] max-w-[240px] w-[23%] bg-transparent backdrop-blur-md shadow-sm">
          <figure class="flex-shrink-0 w-1/2">
            <img
              src="{{ $recommended->cover_img ?? '/images/default-book.jpg' }}"
              alt="{{ $recommended->title }}"
              class="w-full h-full object-cover rounded-xl" />
          </figure>
          <div class="card-body px-3 py-0">
            <div class="flex flex-col space-y-1">
              <a href="{{ route('books.show', $recommended->id) }}"
                class="card-title text-xs text-white font-medium no-underline mt-3 hover:text-base-300">
                {{ Str::limit($recommended->title, 45) }}
              </a>
              <a href="#" class="text-white text-[10px] hover:text-base-300">
                {{ $recommended->author }}
              </a>
              <span class="text-primary text-[10px]">{{ $recommended->year }}</span>
            </div>
            <div class="card-actions justify-start mb-2">
              <a href="{{ route('books.show', $recommended->id) }}"
                class="btn btn-xs btn-success text-white rounded-full shadow-md hover:bg-green-800 transition duration-300">
                read
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>  
  </div>
</div>


</div>
</div>
</div>
  <div class="drawer-side">
    <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-white text-base-content min-h-full w-45 p-4">
      <!-- Sidebar content Start -->
       <li>
         <div>
          <div class="avatar w-32 h-17">
          <a href="{{ route('home') }}">
            <img src="/images/logo-sb.png" alt="Profile" class="w-full h-full" />
          </a>
          </div>
        </div>
      </li>
      <li class="pointer-events-none hover:bg-transparent">
        <span class="text-sm text-black font-semibold">MENU</span>
      </li>
        <li>
          <a href="{{ route('home') }}" class="flex items-center  gap-3 px-3 py-2 rounded-md hover:bg-gray-100">
          <div class="badge badge-primary rounded-md px-1 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
          </div>
           <span class="text-sm text-black">Home</span>
          </a>
        </li>
       <li>
          <details open>
            <summary class="flex items-center gap-3 px-3 py-2 rounded-md bg-gray-100">
              <div class="badge base-300 rounded-md px-1 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                </svg>
              </div>
              <span class="text-sm text-black">Library</span>
            </summary>
            <ul class="ml-6 mt-1 space-y-1 text-xs text-gray-600">
              <li><a href="{{ route('latest') }}" class="text-black">Latest Updates</a></li>
              <li><a href="{{ route('recently') }}" class="text-black">Recently Addes</a></li>
              @auth
              <li><a href="{{ route('libraries') }}" class="text-black">Libraries</a></li>
              @endauth
              <li><a href="{{ route('category') }}" class="text-black">Category</a></li>
            </ul>
          </details>
        </li>
    </ul>
    <p class="absolute bottom-4 ml-4 text-[10px] text-gray-900">2025 ©NotEnoughBooks</p>
  </div>
  <!-- Sidebar content End -->
   
</div>
<!-- Side Bar End -->

    </body>
</html>