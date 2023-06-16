@extends('layout')
@section('content')

<form action="{{ route('recipes.index') }}" method="GET" class="mb-4 mt-12">
  <div class="relative border-2 border-gray-100 m-4 rounded-lg">
    <div class="absolute top-4 left-3">
      <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500 test"></i>
    </div>
    
    <input
      type="text"
      name="search"
      class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow
      focus:outline-none"
      placeholder="Search recipe"
    />
    <div class="absolute top-2 right-2">
      <button
        type="submit"
        class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
      >
        Search
      </button>
    </div>
  </div>
</form>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
  @if ($recipes->isEmpty())
    <p>No recipes found.</p>
  @else 
    @foreach($recipes as $recipe)
    <div class="bg-gray-50 border border-gray-200 rounded p-6 flex">
      <div class="flex flex-col items-center w-full"> 
        <h3 class="text-2xl text-center hover:text-indigo-600"> 
          <a href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
        </h3>
        <div class="flex justify-between items-center mt-4 relative">
          <!-- Heart (like) button -->
          <form action="{{ route('recipes.like', $recipe) }}" method="POST">
            @csrf
            @if ($recipe->isLiked)
              <button type="submit" class="heart-button text-red-500 hover:text-red-600" >
                <i class="fa fa-heart"></i>
              </button>
            @else
               <button type="submit" class="heart-button text-gray-400 hover:text-red-500 relative">
                 <i class="fa fa-heart"></i>
                  <div class="tooltip hidden bg-white text-black text-sm py-1 px-4 rounded-md absolute -top-10 left ">
                  Add recipe to your favorites
                 </div>
                </button>
            
            @endif
          </form>
        </div>
        <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto max-w-200">
      </div>
    </div>
    @endforeach
  @endif
</div>

{{ $recipes->links() }}


<style>
.tooltip {
  /* Increase the width of the tooltip container */
  width: 160px;
  /* Adjust the positioning to accommodate the wider text */
  left: -170px;
  
}

.tooltip p {
  /* Set a fixed height and enable word-wrap for two lines of text */
  height: 2.4em;
  overflow: hidden;
  word-wrap: break-word;
}

</style>

<script>
  const heartButtons = document.querySelectorAll('.heart-button');
  heartButtons.forEach(button => {
    button.addEventListener('mouseover', () => {
      const tooltip = button.querySelector('.tooltip');
      if (tooltip) {
        tooltip.classList.remove('hidden');
      }
    });

    button.addEventListener('mouseout', () => {
      const tooltip = button.querySelector('.tooltip');
      if (tooltip) {
        tooltip.classList.add('hidden');
      }
    });
  });
</script>

@endsection

