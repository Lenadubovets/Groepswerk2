@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <div class="flex flex-wrap pr-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                <i class="fa-solid fa-right-to-bracket text-white text-xl"></i>
            </div>
            <div class="flex items-center justify-center">
                <h2 class="text-2xl font-bold px-2">Welcome back!</h2>
            </div>
            <div class="flex">
                <p class="inline-block text-xs py-2">Enter your credentials to access your Freego.</p>
            </div>
        </div>
        <form method="POST" action="/users/authenticate">
            @csrf
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
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                    value="{{ old('password') }}" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign In
                </button>
            </div>

            <div class="mt-8">
                <p>
                    Don't have an account?
                    <a href="/register" class="text-sm font-semibold leading-6 text-gray-900">Register</a>
                </p>
            </div>
        </form>
    </div>
@endsection
