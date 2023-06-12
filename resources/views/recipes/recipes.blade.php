@extends('layout')
@section('content')

<form action="{{ route('recipes.index') }}" method="GET" class="mb-4 mt-12">
  <div class="relative border-2 border-gray-100 m-4 rounded-lg">
      <div class="absolute top-4 left-3">
          <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500 test"></i></div>
      
          <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow
            focus:outline-none"
            placeholder="Search recipe"/>
            <div class="absolute top-2 right-2">
              <button
              type="submit"
              class="h-10 w-20 text-white rounded-lg bg-red-500
              hover:bg-red-600">Search</button>
            </div>
          
    
  </div>
</form>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
  @if ($recipes->isEmpty())
  <p>No recipes found.</p>
@else 
  @foreach($recipes as $recipe)
      <div class="bg-gray-50 border border-gray-200 rounded p-6 flex">      
        <div class="flex flex-col">
          <h3 class="text-2xl">
            <a href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
          </h3>
          <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto" style="max-width: 200px;">
        </div>
      </div>
    @endforeach
    @endif
  </div>
  {{ $recipes->links() }}
</body>
@endsection