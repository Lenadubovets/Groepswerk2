@extends('layout')

@section('content')
  @if($recipe)
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-md overflow-hidden">
      <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1">
          <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="object-cover h-100 w-full">
        </div>
        <div class="col-span-2 p-6">
          <h1 class="text-4xl font-semibold mb-4">{{ $recipe->name }}</h1>
          <p class="text-gray-600">{{ $recipe->instruction }}</p>
        </div>
        <div class="col-span-3 p-6">
          @if($recipe->ingredients->count() > 0)
            <div class="p-6">
              <h2 class="text-2xl font-semibold mb-4">Ingredients:</h2>
              <ul class="list-disc ml-6 mt-2">
                @foreach($recipe->ingredients as $ingredient)
                  <li>{{ $ingredient->name }}</li>
                @endforeach
              </ul>
            </div>
          @else
            <div class="p-6">
              <p>No ingredients found.</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  @else
    <p>Recipe not found.</p>
  @endif
@endsection




