@extends('layouts.info')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4" style="background-image: url('/images/library-bg.jpg')">
    <div class="bg-white/90 p-10 rounded-3xl shadow-xl w-full max-w-2xl backdrop-blur-sm">
        <h2 class="text-2xl font-bold text-center mb-2">Create account</h2>
        <p class="text-sm text-center text-gray-500 mb-6">Let's create your own account</p>

        <form method="POST" action="/register">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-xs font-medium text-neutral">Your name</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered w-full text-xs" placeholder="Enter your name" required value="{{ old('name') }}" />
                </div>

                <!-- Username -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-xs font-medium text-neutral">Username</span>
                    </label>
                    <input type="text" name="username" class="input input-bordered w-full text-xs" placeholder="Choose a username" required value="{{ old('username') }}" />
                </div>

                <!-- Email -->
                <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text text-xs font-medium text-neutral">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full text-xs" placeholder="Enter your Email" required value="{{ old('email') }}" />
                </div>

                <!-- Password -->
                <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text text-xs font-medium text-neutral">Password</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" class="input input-bordered w-full pr-10 text-xs" placeholder="Enter your Password" required id="passwordInput" />
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
            </div>
            <!-- Admin Role Dropdown -->
            <div class="form-control mt-4">
                <label class="label">
                    <span class="label-text text-xs font-medium text-neutral">Role</span>
                </label>
                <select name="role" class="select select-bordered w-full text-xs" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit" class="btn btn-success w-full text-sm">Create account</button>
            </div>

            <!-- Divider -->
            <div class="text-center text-sm text-gray-400 my-2">Or</div>

            <!-- Login Link -->
            <div>
                <a href="/login" class="btn btn-outline w-full text-sm">Log in</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
