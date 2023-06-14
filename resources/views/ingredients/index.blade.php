@extends('layout')
@section('content')

<div class="py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:text-center">
      <h1 class="text-3xl font-bold mb-6 mt-6">Your FREEGO Ingredients</h1>
      @include('ingredients.search', ['ingredients' => $ingredients, 'selectedIngredients' => $selectedIngredients])
    </div>
    <div class="mx-auto mt-16 max-w-7xl grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
        <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fa-solid fa-clipboard-list text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold">Your FREEGO List</h2>
            </dt>
            <dd>
                @include('ingredients.fridge', ['fridgeListIngredients' => $fridgeListIngredients, 'shoppingListIngredientsIds' => $shoppingListIngredientsIds])
            </dd>
        </div>
        <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fa-solid fa-utensils text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold">What can you make?</h2>
            </dt>
            <dd>
                @include('ingredients.recipes')
            </dd>
        </div>
        <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fa-regular fa-thumbs-up text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold">Favorite recipes</h2>
            </dt>
            <dd class="mt-2 text-base leading-7 text-gray-600">
                @include('ingredients.favorites')
            </dd> 
        </div>
    </div>
  </div>
</div>
@endsection

