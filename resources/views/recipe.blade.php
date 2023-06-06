@extends('layout')

@section('content')
  @if($recipe)
    <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden">
      <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="object-cover h-56 w-full">
      <div class="p-4">
        <h1 class="text-2xl font-semibold mb-2">{{ $recipe->name }}</h1>
        <p class="text-gray-600">{{ $recipe->instruction }}</p>

        @if($recipe->ingredients->count() > 0)
          <h2 class="text-lg font-semibold mt-4">Ingredients:</h2>
          <ul class="list-disc ml-6 mt-2">
            @foreach($recipe->ingredients as $ingredient)
              <li>{{ $ingredient->name }}</li>
            @endforeach
          </ul>
        @else
          <p>No ingredients found.</p>
        @endif
      </div>
    </div>
  @else
    <p>Recipe not found.</p>
  @endif
@endsection
