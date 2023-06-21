@if ($fridgeListIngredients->count() > 0)
    @if (session('success'))
        <div class="bg-green-200 text-green-800 rounded-md p-2 mb-4">
            {{ session('success') }}
        </div>
        <?php session()->forget('success'); ?>
    @endif
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left">Ingredient</th>
                    <th class="py-2 px-4 text-left">Quantity</th>
                    <th class="py-2 px-4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fridgeListIngredients as $ingredient)
                    <tr>
                        <td class="py-2">
                            <span>{{ $ingredient->name }}</span>
                        </td>
                        <td>
                            <form action="{{ route('updateQuantities') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="ingredient_id" value="{{ $ingredient->id }}">
                                <div class="flex">
                                    <input type="number" name="quantity" class="py-2 px-4 w-16 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" min="1" value="{{ $ingredient->quantity }}">
                                    <select name="unit" class="ml-2 rounded-md border-b-2 border-black text-xs">
                                        <option value="liter">Liter(s)</option>
                                        <option value="gram">Gram(s)</option>
                                        <option value="piece">Piece(s)</option>
                                    </select>
                                    <button type="submit" class="text-xs text-white bg-green-500 hover:bg-green-700 rounded-lg px-2 py-1 ml-2" data-tippy-content="Update Amount">
                                        Save amount
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="space-y-2">
                                <form action="{{ route('shoppinglist.store', $ingredient->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="list" value="shoppingList">
                                    @if(in_array($ingredient->id, $shoppingListIngredientsIds))
                                        <button class="text-xs text-white bg-gray-300 rounded-lg px-2 py-1" disabled  data-tippy-content="Already In Shopping List">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    @else
                                        <button class="text-xs text-white bg-blue-500 hover:bg-indigo-600 rounded-lg px-2 py-1"  data-tippy-content="Add to Shopping List">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    @endif
                                </form>
                                <form action="{{ route('ingredients.delete', ['id' => $ingredient->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs text-white bg-red-500 hover:bg-red-700 rounded-lg px-2 py-1" type="submit"  data-tippy-content="Remove From Freego">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No ingredients added to the list.</p>
@endif
