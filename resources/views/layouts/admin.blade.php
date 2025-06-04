<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">
  @vite('resources/css/app.css')
</head>

<body>
  <!-- NAVBAR START -->
  <div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent shadow-none">
    <div class="navbar-start"></div>
    <div class="navbar-end flex items-center gap-4">
      <form action="{{ route('search-books-admin') }}" method="GET" class="flex items-center">
        <label class="flex items-center gap-2 px-2 py-1 h-7 rounded-full bg-white w-90 max-w-xs">
          <svg class="w-3 h-3 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.3-4.3"></path>
            </g>
          </svg>
          <input type="text" name="query"
            class="grow text-[10px] placeholder:text-[11px] leading-none bg-transparent focus:outline-none"
            placeholder="Search the book you like..." />
        </label>
      </form>
      <div class="flex items-center">
        <a href="{{ route('profile') }}" class="btn btn-ghost btn-sm flex items-center gap-2 cursor-pointer">
          <div class="avatar">
            <img
              src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/images/default-avatar.png') }}"
              alt="User Avatar" class="w-5 h-5 rounded-full object-cover" />
          </div>
          <span class="text-xs text-white font-semibold">{{ Auth::user()->username ?? Auth::user()->name }}</span>
        </a>
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button" class="btn btn-ghost btn-xs text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
              class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path
                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
            </svg>
          </div>
          <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 rounded-box mt-3 w-35 p-2 shadow z-[1]">
            <li>
              <a href="{{ route('profile') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="text-[10] ml-1">profile</span>
              </a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-1 text-[10px] ml-1 w-full">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd"
                      d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                  </svg>
                  <span class="text-[10] ml-1">Sign out</span>
                </button>
              </form>
            </li>
          </ul>
        </div>
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
        <a href="{{ route('add-book') }}"
          class="w-full bg-gray-200 hover:bg-gray-300 text-black font-semibold py-2 px-4 rounded-md flex items-center justify-center gap-2 mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
            viewBox="0 0 16 16">
            <path
              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
          </svg>
          Add Book
        </a>
      </li>
      <li class="pointer-events-none hover:bg-transparent">
        <span class="text-sm text-black font-semibold">MENU</span>
      </li>
      <li>
        <a href="{{ route('home-admin') }}" class="flex items-center  gap-3 px-3 py-2 rounded-md hover:bg-gray-100">
          <div class="badge badge-primary rounded-md px-1 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house"
              viewBox="0 0 16 16">
              <path
                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
            </svg>
          </div>
          <span class="text-sm text-black">Home</span>
        </a>
      </li>
      <li>
        <details open>
          <summary class="flex items-center gap-3 px-3 py-2 rounded-md bg-gray-100">
            <div class="badge base-300 rounded-md px-1 py-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal"
                viewBox="0 0 16 16">
                <path
                  d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                <path
                  d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
              </svg>
            </div>
            <span class="text-sm text-black">Library</span>
          </summary>
          <ul class="ml-6 mt-1 space-y-1 text-xs text-gray-600">
            <li><a href="{{ route('latest-admin') }}" class="text-black">Latest Updates</a></li>
            <li><a href="{{ route('recently-admin') }}" class="text-black">Recently Addes</a></li>
            <li><a href="{{ route('libraries-admin') }}" class="text-black">Libraries</a></li>
            <li><a href="{{ route('category-admin') }}" class="text-black">Category</a></li>
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