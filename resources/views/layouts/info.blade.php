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
        <div class="flex justify-between items-center w-full px-4 relative">
            <div class="navbar-start">
                <a href="{{ route('home') }}" class="btn btn-ghost btn-sm flex items-center cursor-pointer">
                    <div class="avatar w-7 h-7">
                        <a href="/" class="m-0 p-0">
                            <img src="/images/logo-short.png" alt="Profile"
                                class="w-full h-full rounded-full object-cover" />
                        </a>
                    </div>
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