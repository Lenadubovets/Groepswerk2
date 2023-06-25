@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <div class="relative pl-16 h-20">
            <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600">
                <i class="fa-solid fa-cart-shopping text-white text-xl"></i>
            </div>
            <div class="absolute flex h-12 items-center justify-center">
                <h2 class="text-2xl font-bold">Your Shopping List</h2>
            </div>
        </div>
        <div class="container mx-auto">
            <!-- Check if shopping list is not empty -->
            @if (count($shoppingListIngredients) > 0)
                <div class="grid grid-cols-12">
                    <div class="col-span-8">
                        <!-- Show items in the shopping list -->
                        @foreach ($shoppingListIngredients as $ingredient)
                            <form action="{{ route('shoppinglist.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="flex items-center">
                                    <input type="checkbox" name="selectedIngredients[]" value="{{ $ingredient->id }}"
                                        class="ingredient-checkbox">
                                    <span class="ml-2">{{ $ingredient->name }}</span>
                                </div>
                        @endforeach
                    </div>
                    <div class="col-span-4 flex flex-col justify-center">
                        <!-- Remove button -->
                        <button type="submit" id="removeButton"
                            class="bg-gray-300 cursor-not-allowed text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            disabled data-tippy-content="Remove Selected Ingredients">
                            Remove Selected
                        </button>
                        <!-- Share button -->
                        <button type="button" id="shareButton"
                            class="mt-4 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 " data-tippy-content="Share Your Shopping List">
                            <i class="fas fa-share-square"></i> Share
                        </button>
                    </div>
                    </form>
                </div>
            @else
                <p class="ml-2">Your shopping list is empty!</p>
            @endif
            </div>
        </div>

    <!-- Share shopping list -->
    <script>
            $('#shareButton').click(function() {
                //AJAX-request to post to the route
                $.ajax({
                    url: '/shoppinglist/share',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'Success',
                            title: 'Link generated',
                            text: 'Here is your link: ' + data.link,
                            footer: '<button id="copyButton" class="btn btn-primary">Copy Link</button>'
                        });

                        $("#copyButton").click(function() {
                            var $temp = $("<input>");
                            $("body").append($temp);
                            $temp.val(data.link).select();
                            document.execCommand("copy");
                            $temp.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Copied!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        });
                    }
                });
            });
        //Dynamically disable and enable button
        $(document).ready(function() {
            $('.ingredient-checkbox').change(function() {
                var itemsChecked = $('.ingredient-checkbox:checked').length > 0;
                $('#removeButton').prop('disabled', !itemsChecked);
                updateRemoveButtonStyle();
            });

            function updateRemoveButtonStyle() {
                const removeButton = document.getElementById('removeButton');
                const checkedIngredients = document.querySelectorAll('.ingredient-checkbox:checked');

                if (checkedIngredients.length > 0) {
                    removeButton.removeAttribute('disabled');
                    removeButton.classList.remove('bg-gray-300', 'cursor-not-allowed');
                    removeButton.classList.add('bg-indigo-600', 'hover:bg-blue-700');
                } else {
                    removeButton.setAttribute('disabled', 'disabled');
                    removeButton.classList.remove('bg-indigo-600', 'hover:bg-blue-700');
                    removeButton.classList.add('bg-gray-300', 'cursor-not-allowed');
                }
            }
        });
    </script>
@endsection
