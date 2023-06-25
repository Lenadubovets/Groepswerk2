@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <div class="flex flex-wrap pr-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                <i class="fa-solid fa-user-plus text-white text-xl"></i>
            </div>
            <div class="flex items-center justify-center">
                <h2 class="text-2xl font-bold px-2">Create an account</h2>
            </div>
            <div class="flex">
                <p class="inline-block text-xs py-2">Create your own Freego account and start reducing food waste!</p>
            </div>
        </div>
        <form method="POST" action="/users">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ old('email') }}" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">
                    Password
                </label>
                <div class="relative">
                    <input type="password" class="border border-gray-200 rounded p-2 w-full pr-10" name="password"
                        id="new_password">
                    <i class="fa-regular fa-eye-slash absolute top-1/2 right-2 transform -translate-y-1/2 cursor-pointer"
                        id="password_toggle" onclick="togglePasswordVisibility()" required data-tippy-content="Show/Hide Password"></i>
                </div>
                <p class="text-xs">Must be at least 6 characters.</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="inline-block text-lg mb-2">
                    Confirm Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" />
                    <p class="text-xs">Both passwords must match.</p>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" 
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign Up
                </button>
            </div>

            <div class="mt-8">
                <p>
                    Already have an account?
                    <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Login</a>
                </p>
            </div>
        </form>
    </div>
    <!-- Show/Hide Password -->
    <script src="{{ asset('js/password-toggle.js') }}"></script>
@endsection


