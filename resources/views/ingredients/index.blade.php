@extends('layout')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4 mt-20">
        <div class="mb-6">
            @include('ingredients.search', ['ingredients' => $ingredients, 'selectedIngredients' => $selectedIngredients])
        </div>
        <div class="mb-6">
            @include('ingredients.fridge', ['fridgeListIngredients' => $fridgeListIngredients])

        </div>
        <div class="mb-6">
            @include('ingredients.recipes')
        </div>
    </div>  
@endsection


