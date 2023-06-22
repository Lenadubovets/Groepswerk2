@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <div class="relative pl-16 h-12">
            <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                <i class="fa-solid fa-user-pen text-white text-xl"></i>
            </div>
            <div class="absolute flex h-12 items-center justify-center">
                <h2 class="text-2xl font-bold">Your Profile</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('update.profile') }}">
            @csrf
            <div class="container mx-auto pt-2 pb-6">
                <div class="flex justify-between">
                    <div class="w-2/3 flex items-center">
                        <p class="text-s">Update your profile</p>
                    </div>
                    <div class="w-1/3">
                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="rounded-md bg-green-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input type="name" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ $user->name }}" />
            </div>
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">
                    Email
                </label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ $user->email }}" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </form>
        <div class="mb-6 flex justify-center py-5">
            <a href="{{ route('change.password') }}" type="submit"
                class="w-5/6 rounded-md bg-neutral-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Change Password
            </a>
        </div>
    </div>
@endsection
