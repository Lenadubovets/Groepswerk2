



        <h1 class="text-3xl font-bold mb-6 mt-6">Your FREEGO Ingredients</h1>

        <form action="" method="GET" class="mb-6 flex items-center">
            <input type="text" name="query" placeholder="Search for ingredients..." class="py-2 px-4 rounded-md border border-gray-300 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Search</button>
        </form>

        @if ($ingredients->count() > 0)
            <h2 class="text-2xl font-bold mb-4">Search Results</h2>
            <ul>
                @foreach ($ingredients as $ingredient)
                    <li class="mb-2">
                        {{ $ingredient->name }}
                        <form action="{{ route('ingredients.addToSelected', $ingredient) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-white bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1">Add to List</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No ingredients found.</p>
        @endif
 
