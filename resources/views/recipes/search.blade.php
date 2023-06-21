@extends('layout')
@section('content')
    <div class="mt-20 "></div>
    <h1 class="mb-10">Recipes you can already make:</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
        @if ($recipes->count() > 0)
        @foreach($recipes as $recipe)
        @include('components.recipe-card', ['recipes' => $recipes])
        @endforeach
        @else
            <p>No recipes found 😭</p>
        @endif
    </div>
    </body>

@endsection
