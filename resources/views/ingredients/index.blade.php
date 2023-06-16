@extends('layout')
@section('content')

<div class="py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:text-center">
      <h1 class="text-3xl font-bold mb-6 mt-6">Your FREEGO Ingredients</h1>
      <p>Search here all the ingredients that you have in your FREEGO and later add them to your FREEGO list</p>
      @include('ingredients.search', ['ingredients' => $ingredients, 'selectedIngredients' => $selectedIngredients])
    </div>
    <div class="mx-auto mt-16 max-w-7xl grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
        <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fa-solid fa-clipboard-list text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold">Your FREEGO List</h2>
                <p>Here you can see all the added ingredients</p>
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
                <h2 class="text-2xl font-bold">What can you cook?</h2>
                <p>
                    Please take a look in here 😉, you can search for all the awesome recipes!
                </p>
            </dt>
            <dd>
                @include('ingredients.recipes')
            </dd>
        </div>
        <div class="relative pl-16">
            <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fa-solid fa-heart text-white text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold">My favorite recipes</h2>
                <p> If you liked it, you will find it here</p>
            </dt>
            <dd class="mt-2 text-base leading-7 text-gray-600">
                @include('ingredients.favorites', ['recipes' => $recipes])
            </dd> 
        </div>
    </div>
  </div>
</div>
@endsection

