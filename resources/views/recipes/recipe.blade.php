@extends('layout')

@section('content')
    @if ($recipe)
        <div class="max-w-6xl mx-auto bg-white shadow-md rounded-md overflow-hidden mt-24">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="object-cover h-100 w-full">
                </div>
                <div class="col-span-2 p-6">
                    <h1 class="text-4xl font-semibold mb-4">{{ $recipe->name }}</h1>
                    <p class="text-gray-600">{{ $recipe->instruction }}</p>
                </div>
                <div class="col-span-1 p-6">
                    @if ($recipe->ingredients->count() > 0)
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-4">Ingredients:</h2>
                            <ul class="list-disc ml-6 mt-2 w-full w-64 " style="list-style-type: none;">
                            @foreach ($sortedIngredients as $ingredient)
                                <!-- Check if the ingredient is in the shopping list -->
                                @php
                                    $isInShoppingList = $userShoppingListIngredients->contains($ingredient->id);
                                    $isUserIngredient = $userFridgeListIngredients->contains($ingredient->id);
                                @endphp
                                <li>
                                    <label class="{{ ($isInShoppingList && !$isUserIngredient) ? 'text-blue-500' : ($isUserIngredient ? 'text-green-500' : 'text-orange-500') }}"
                                        data-tippy-content="{{ ($isInShoppingList && !$isUserIngredient) ? 'In Shopping List' : ($isUserIngredient ? 'In Fridge List' : 'Missing Ingredient') }}"
                                        >
                                        <input type="checkbox" name="selectedIngredients[]" value="{{ $ingredient->id }}"
                                        {{ ($isInShoppingList || $isUserIngredient) ? 'disabled' : '' }}
                                        >
                                        <span>{{ $ingredient->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <button class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mt-10" data-tippy-content="Add Selected Ingredients to Shopping List" id="add-selected-btn">Add to Shopping List</button>
                    @else
                        <div class="p-6">
                            <p>No ingredients found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <p>Recipe not found.</p>
    @endif
    <div class="mt-6 flex justify-end">
        <a href="{{ route('recipes.download', $recipe->id) }}" class="text-blue-500 hover:underline mr-4">
            Download PDF
        </a>
        <button onclick="printRecipe()" class="text-blue-500 hover:underline">
            Print Recipe
        </button>
    </div>
    
    <script>
        function printRecipe() {
            // Hide elements that should not be printed
            var elementsToHide = document.querySelectorAll('#headertop, mobileheader');
            elementsToHide.forEach(function(element) {
                element.style.display = 'none';
            });

            // Trigger the browser's print functionality
            window.print();

            // Restore the hidden elements after printing
            elementsToHide.forEach(function(element) {
                element.style.display = '';
            });
        }
    </script>

<script>
        $(document).ready(function() {
    $('#add-selected-btn').click(function() {
        var selectedIngredients = [];
        $('input[name="selectedIngredients[]"]:checked').each(function() {
            selectedIngredients.push($(this).val());
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var completedRequests = 0;
        var totalRequests = selectedIngredients.length;

        //Send Ingredient ID to Laravel controller with AJAX 
        $.each(selectedIngredients, function(index, ingredientId) {
            $.ajax({
                url: '/shoppinglist/' + ingredientId,
                type: 'POST',
                data: {
                    ingredientId: ingredientId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);

                    //If successful, disable checkbox and change color to blue
                    if (response.success) {
                        $('input[name="selectedIngredients[]"][value="' + ingredientId + '"]').attr('disabled', true)
                            .siblings('span').addClass('text-blue-500').removeClass('text-orange-500');
                    } else {
                        // If not successful, show error message somehow (maybe in a flash-message box)
                        $('.flash-message').html('<div class="fixed top-0 left-1/2 transform -translate-x-1/2 px-48 py-3"><p>' + response.message + '</p></div>');
                    }

                    //Increase the completed requests counter
                    completedRequests++;

                    // Check if all requests have completed
                    if (completedRequests === totalRequests) {
                        if (response.success) {
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);

                    //Increase the completed requests counter
                    completedRequests++;

                    // Check if all requests have completed
                    if (completedRequests === totalRequests) {
                        location.reload();
                    }
                }
            });
        });
    });
});
</script>

<!-- Add Tooltip depending on the color -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]', {
            placement: 'top',
            onShow(instance) {
                const labelElement = instance.reference;
                const ingredientColor = labelElement.classList[0];

                let tooltipContent = '';
                if (ingredientColor === 'text-blue-500') {
                    tooltipContent = 'In Shopping List';
                } else if (ingredientColor === 'text-green-500') {
                    tooltipContent = 'In Freego';
                } else if (ingredientColor === 'text-orange-500') {
                    tooltipContent = 'Missing Ingredient';
                }

                instance.setContent(tooltipContent);
            },
        });
    });
</script>

@endsection
