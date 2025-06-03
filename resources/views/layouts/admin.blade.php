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
        <a class="btn btn-ghost btn-sm flex items-center gap-2 cursor-pointer">
          <div class="avatar">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
          </svg>
          </div>
          <span class="text-xs text-white font-semibold">Admin</span>
        </a>
        </div>
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

  @yield('content')          
  
<!-- Content end-->  

</div>
 <div class="fixed bottom-8 left-[56%] -translate-x-1/2 z-50">
  <div class="join shadow-lg rounded-xl bg-white/80 backdrop-blur-md px-4 py-2 space-x-1">
    <input class="join-item btn btn-xs rounded-md hover:bg-green-500 hover:text-white transition-all duration-300" type="radio" name="options" aria-label="prev" checked />
    <input class="join-item btn btn-xs rounded-md" type="radio" name="options" aria-label="1" />
    <input class="join-item btn btn-xs rounded-md" type="radio" name="options" aria-label="2" />
    <input class="join-item btn btn-xs rounded-md" type="radio" name="options" aria-label="3" />
    <input class="join-item btn btn-xs rounded-md" type="radio" name="options" aria-label="4" />
    <input class="join-item btn btn-xs rounded-md hover:bg-green-500 hover:text-white transition-all duration-300" type="radio" name="options" aria-label="next" />
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
            <a href="{{ route('home-admin') }}">
              <img src="/images/logo-sb.png" alt="Profile" class="w-full h-full" />
            </a>
          </div>
        </div>
      </li>
      <li>
        <a href="{{ route('add-book') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-black font-semibold py-2 px-4 rounded-md flex items-center justify-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
          Add Book
        </a>
        </li>
        <li>
        <a href="{{ route('edit-book') }}" class="w-full bg-green-300 hover:bg-green-400 text-black font-semibold py-2 px-4 rounded-md flex items-center justify-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1 1a.5.5 0 0 1-.708 0L13 3.207l1-1a.5.5 0 0 1 .708 0l.794.733zm-1.75 2.456l-1-1L5 11.146V12h.854l8.898-8.898z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-7a.5.5 0 0 0-1 0v7a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
            Edit Book
        </a>
        </li>
      <li class="pointer-events-none hover:bg-transparent">
        <span class="text-sm text-black font-semibold">MENU</span>
      </li>
        <li>
          <a href="{{ route('home-admin') }}" class="flex items-center  gap-3 px-3 py-2 rounded-md hover:bg-gray-100">
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
              <li><a href="{{ route('libraries') }}" class="text-black">Libraries</a></li>
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
