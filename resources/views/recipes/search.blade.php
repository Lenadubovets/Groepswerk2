@extends('layout')
@section('content')
    <div class="mt-20 "></div>
    <h1 class="mb-10">Recipes you can already make:</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
        @if ($recipes->count() > 0)
            @foreach ($recipes as $recipe)
            <div class="bg-gray-50 border border-gray-200 rounded p-6 flex">
                <div class="flex flex-col items-center"> <!-- Added 'items-center' class to center the content horizontally -->
                  <h3 class="text-2xl hover:text-blue-500">
                    <a href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
                  </h3>
                  <div class="flex justify-between items-center mt-4"> 
                    <!-- Heart (like) button -->
                    <form action="{{ route('recipes.like', $recipe) }}" method="POST">
                      @csrf
                      <button type="submit" class="text-red-500 hover:text-red-600">
                        <i class="fa fa-heart"></i>
                      </button>
                    </form>
                  </div>
                  <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto max-w-200">
                </div>
              </div>
            @endforeach
        @else
            <p>No recipes found 😭</p>
        @endif
    </div>
    </body>
@endsection
