<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @vite('resources/css/app.css')
    </head>
    <body>
<!-- NAVBAR START -->
    <div class="navbar fixed top-0 left-0 right-0 z-50 bg-transparent shadow-none">
  <div class="flex justify-between items-center w-full px-4 relative">
    <div class="navbar-start">
        <a class="btn btn-ghost btn-sm flex items-center cursor-pointer">
        <div class="avatar w-7 h-7">
            <img src="/images/logo-short.png" alt="Profile" class="w-full h-full rounded-full object-cover" />
        </div>
        </a>
    </div>
    <div class="navbar-end">
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
  </div>
</div>
<!-- Navbar End -->


<!-- Content Start -->
  <div class="hero min-h-screen" style="background-image: url('/images/bg-landing.svg');">
    
  @yield('content')        
  
  </div>      
<!-- Content End -->


<!-- Footer Start -->
        <footer class="footer footer-horizontal footer-center bg-primary text-primary-content p-5">
        <aside>
            <p class="font-bold text-sm">
            Not Enough Book.
            <br />
            Final Project Website Programing
            </p>
            <p class="text-xs">Copyright © 2025 - All right reserved</p>
        </aside>
        </footer>
<!-- Footer End -->


    </body>
</html>
