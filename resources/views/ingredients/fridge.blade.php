
        <div>
            @if ($fridgeListIngredients->count() > 0)
                <h2 class="text-2xl font-bold mb-4">FREEGO List</h2>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fridgeListIngredients as $ingredient)
                            <tr>
                                <td class="flex justify-between items-center py-2">
                                    <span>{{ $ingredient->name }}</span>
                                </td>
                                <td>
                                    <input type="number" name="quantity[{{ $ingredient->id }}]" class="py-2 px-4 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" value="1">
                                </td>
                                <td>
                                    <div>
                                        <form action="{{ route('shoppinglist.store', ['id' => $ingredient->id]) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="list" value="shoppingList">
                                            <button class="text-xs text-white bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('ingredients.delete', ['id' => $ingredient->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-xs text-white bg-red-500 hover:bg-red-700 rounded-lg px-2 py-1" type="submit">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No ingredients added to the list.</p>
            @endif
    </div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">What can you make?</h2>
            <form action="{{ route('recipes.search') }}" method="GET">
                <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">Search Recipes</button>
            </form>
    </div>
    </div>
</div>
