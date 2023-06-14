@extends('layout')
@section('content')

<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:text-center">
      <h1 class="text-3xl font-bold mb-6 mt-6">Your FREEGO Ingredients</h1>
      @yield('section-search')
    </div>
    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl grid grid-cols-1 gap-8 md:grid-cols-3">
      <div class="relative pl-16">
        <dt class="text-base font-semibold leading-7 text-gray-900">
          <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-500">
            <i class="fa-solid fa-clipboard-list text-black text-xl "></i>
          </div>
          <h2 class="text-2xl font-bold">Your FREEGO List</h2>
        </dt>
        <dd class="mt-2 text-base leading-7 text-gray-600">
          <!-- Content for Your FREEGO List -->


        </dd>
      </div>
      <div class="relative pl-16">
        <dt class="text-base font-semibold leading-7 text-gray-900">
          <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-500">
            <i class="fa-solid fa-utensils text-black text-xl"></i>
          </div>
          <h2 class="text-2xl font-bold">What can you make?</h2> 
        </dt>
        <dd class="mt-2 text-base leading-7 text-gray-600">
          <!-- Content for What can you make? -->
          @include('ingredients.recipes')
        </dd>
      </div>
      <div class="relative pl-16">
        <dt class="text-base font-semibold leading-7 text-gray-900">
          <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-500">
            <i class="fa-regular fa-thumbs-up text-black text-xl "></i>
          </div>
          <h2 class="text-2xl font-bold">Favorite recipes</h2>
        </dt>
        <dd class="mt-2 text-base leading-7 text-gray-600">
          <!-- Content for Favorite recipes -->
        </dd>
      </div>
    </div>
  </div>
</div>
@endsection 
