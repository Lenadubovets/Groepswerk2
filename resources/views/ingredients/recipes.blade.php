@if($fridgeListIngredients->count() > 0)
        <form action="{{ route('recipes.search') }}" method="GET">
            <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-10" type="submit">Search Recipes</button>
        </form>
    @else
        <p>Add some ingredients and see the magic happen!</p>
    @endif
