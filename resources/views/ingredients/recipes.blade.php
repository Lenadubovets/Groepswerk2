<div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">What can you make?</h2>
        @if($fridgeListIngredients->count() > 0)
            <form action="{{ route('recipes.search') }}" method="GET">
                <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Search Recipes</button>
            </form>
        @else
            <p>Add some ingredients and see the magic happen!</p>
        @endif
    </div>