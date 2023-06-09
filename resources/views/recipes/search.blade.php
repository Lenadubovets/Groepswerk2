@extends('layout')
@section('content')
    <div class="mt-20 "></div>
    <h1 class="mb-10">Recipes you can already make:</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
        @if ($recipes->count() > 0)
            @foreach ($recipes as $recipe)
                <div class="bg-gray-50 border border-gray-200 rounded p-6 flex">
                    <div class="flex flex-col">
                        <h3 class="text-2xl">
                            <a href="/recipe/{{ $recipe['id'] }}">{{ $recipe->name }}</a>
                        </h3>
                        <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto"
                            style="max-width: 200px;">
                    </div>
                </div>
            @endforeach
        @else
            <p>No recipes found 😭</p>
        @endif
    </div>
    </body>
@endsection
