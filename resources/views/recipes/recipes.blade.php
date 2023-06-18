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
    @include('components.recipe-card', ['recipes' => $recipes])
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

