@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <div class="relative pl-16 h-12">
            <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                <i class="fa-solid fa-lock text-white text-xl"></i>
            </div>
            <div class="absolute flex h-12 items-center justify-center">
                <h2 class="text-2xl font-bold">Change Password</h2>
            </div>
        </div>
        <form method="POST" action="{{  route('update.password') }}">
            @csrf
            <div class="mb-6 pt-4">
                <label for="current_password" class="inline-block text-lg mb-2" >Current Password</label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="current_password" autocomplete="off" required />
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="new_password" class="inline-block text-lg mb-2">New Password</label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="new_password" required />
                @error('new_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="new_password_confirmation" class="inline-block text-lg mb-2">Confirm New Password</label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="new_password_confirmation" required />
                @error('new_password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="rounded-md bg-green-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update Password
                </button>
            </div>
        </form>
    </div>
@endsection