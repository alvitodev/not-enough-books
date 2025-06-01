<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @vite('resources/css/app.css')
    </head>
    <body>

<!-- Navbar Start -->
<div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent shadow-none">
  <div class="navbar-start"></div>
  <div class="navbar-end flex items-center gap-4">

    @guest
      {{-- Navbar untuk Guest --}}
      <div class="flex items-center">
        <a class="btn btn-ghost btn-sm flex items-center gap-2 cursor-pointer">
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
        <a class="btn btn-ghost btn-xs text-x2 flex items-center gap-2 cursor-default">
          <div class="avatar">
            <div class="ring-white ring-offset-base-100 w-5 rounded-full ring-1 ring-offset-1">
              <img src="{{ Auth::user()->profile_picture_url ?? 'default.png' }}" />
            </div>
          </div>
          <span class="text-xs text-white">Username</span>
        </a>
        <div class="dropdown dropdown-end">
             <div tabindex="0" role="button" class="btn btn-ghost btn-xs text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 rounded-box mt-3 w-35 p-2 shadow z-[1]">
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>   
                <span class="text-[10] ml-1">profile</span>
                </a>
            </li>
            <li>
                <a>
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                    </svg>  
                    <span class="text-[10] ml-1">Sign out</span>
                </a>
            </li>
            </ul>
        </div>
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
   
   <!-- Content start-->
      <div class="bg-cover bg-center min-h-screen px-8 py-12" style="background-image: url('/images/background-library.jpg')">
  <div class="flex justify-between items-center mb-8 ml-3">
    <h1 class="text-4xl font-bold text-white">Discover</h1>
  </div>

  <!-- Search Bar -->
<div class="flex items-center gap-0 overflow-hidden rounded-full bg-white w-3/5 h-11 mb-12 shadow-lg">
  <!-- Category Select -->
  <select class="select rounded-none rounded-l-full bg-white text-neutral border-none w-40 focus:outline-none focus:ring-0">
    <option selected>All Category</option>
    <option>Science</option>
    <option>Fiction</option>
    <option>History</option>
  </select>

  <!-- Search Input -->
  <input type="text" placeholder="Find The Books You Like..." class="input rounded-none bg-white text-neutral border-x-0 border-none flex-1 focus:outline-none focus:ring-0 placeholder-base-300" />

  <!-- Search Button -->
 <button class="bg-primary text-neutral text-sm font-semibold rounded-full px-4 h-7 shadow-md hover:bg-green-800 hover:text-white transition duration-300 ease-in-out mr-2">
  Search
</button>
</div>

  <!-- Latest Updates -->
<div class="mb-10 ">
  <h2 class="text-2xl text-white font-semibold ml-3 mb-5">Latest Updates</h2>

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

  <!-- Recently Addes -->
  <div class="mb-10 ">
  <h2 class="text-2xl text-white font-semibold mb-5 ml-3">Recently Addes</h2>

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
  <!-- Content End-->  
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
            <img src="/images/logo-sb.png" alt="Profile" class="w-full h-full" />
          </div>
        </div>
      </li>
      <li class="pointer-events-none hover:bg-transparent">
        <span class="text-sm text-black font-semibold">MENU</span>
      </li>
        <li>
          <a class="flex items-center  gap-3 px-3 py-2 rounded-md hover:bg-gray-100">
          <div class="badge badge-primary rounded-md px-1 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
          </div>
           <span class="text-[1] text-black">Home</span>
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
              <span class="text-[1] text-black">Library</span>
            </summary>
            <ul class="ml-6 mt-1 space-y-1 text-sm text-gray-600">
              <li><a class="text-black">Latest Updates</a></li>
              <li><a class="text-black">Recently Addes</a></li>
              <li><a class="text-black">Category</a></li>
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
