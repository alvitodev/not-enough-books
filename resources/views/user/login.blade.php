@extends('layouts.info')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4" style="background-image: url('/images/library-bg.jpg')">
    <div class="bg-white/90 p-12 rounded-2xl shadow-xl w-full max-w-3xl backdrop-blur-sm">
        <h2 class="text-lg font-bold text-center mb-2">Welcome Back!</h2>
        <p class="text-sm text-center text-gray-500 mb-8">We missed you! Please enter your detail</p>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text text-neutral text-sm">Email</span>
                </label>    
                <input type="email" name="email" class="input input-bordered w-full text-sm" placeholder="Enter your Email" required />
            </div>

            <div class="form-control mb-3">
                <label class="label">
                    <span class="label-text text-neutral text-sm">Password</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" class="input input-bordered w-full pr-10 text-sm" placeholder="Enter your Password" required id="passwordInput" />
                    <button type="button" onclick="togglePassword()" class="absolute right-2 top-2 text-gray-500">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Role Selector -->
            <div class="form-control mb-5">
                <label class="label">
                    <span class="label-text text-neutral text-sm">Login As</span>
                </label>
                <select name="is_admin" class="select select-bordered w-full text-sm" required>
                    <option value="0" selected>User</option>
                    <option value="1">Admin</option>
                </select>
            </div>

            <div class="flex justify-between items-center text-xs mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="checkbox checkbox-sm scale-90" name="remember" />
                    Remember me
                </label>
                <a href="#" class="text-green-500 hover:underline">Forgot Password?</a>
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-success w-full text-sm">Log in</button>
            </div>

            <div>
                <a href="/register" class="btn btn-outline w-full text-sm">Create account</a>
            </div>
        </form>
    </div>
</div>

{{-- Toggle password visibility --}}
<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection