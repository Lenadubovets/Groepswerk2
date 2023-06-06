

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
    @foreach($recipes as $recipe)
      <div class="bg-gray-50 border border-gray-200 rounded p-6 flex">
        {{-- <img class="w-48 mr-6 hidden md:block" src="{{asset('images/Syntra.jpg')}}"  alt="Teacher Image"> --}}
        <div class="flex flex-col">
          <h3 class="text-2xl">
            <a href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
          </h3>
          <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto" style="max-width: 200px;">
        </div>
      </div>
    @endforeach
  </div>
  
