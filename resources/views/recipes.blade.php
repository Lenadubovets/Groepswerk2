<h1 class="text-2xl font-semibold mb-6">List of Recipes</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
  @foreach($recipes as $recipe)
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold mb-2">{{ $recipe->name }}</h2>
      <p class="text-gray-600">{{ $recipe->instruction }}</p>
      <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto" style="max-width: 200px;">
    </div>
  @endforeach
</div>


