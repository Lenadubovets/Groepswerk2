
        <form action="" method="GET">
              <div class="mb-6 flex">
                  <input
                    type="text"
                    name="query"
                    class="py-2 px-4 rounded-md border border-gray-300 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-500 h-14 w-full pl-10 pr-10 z-0 focus:shadow"
                    placeholder="Search for ingredients..."
                  />
                  <button
                    type="submit"
                    class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 h-14"
                  >
                    Search
                  </button>
                </div>
                
          </form>

          @if ($ingredients->count() > 0)
              <h2 class="text-2xl font-bold mb-4">Search Results</h2>
              <ul>
                  @foreach ($ingredients as $ingredient)
                      <li class="mb-2">
                          {{ $ingredient->name }}
                          <form action="{{ route('ingredients.store', ['ingredient' => $ingredient->id]) }}" method="POST" class="inline">
                              @csrf
                              <input type="hidden" name="list" value="fridgeList">
                              <button type="submit" class="text-xs text-white bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1">Add to List</button>
                          </form>
                      </li>
                  @endforeach
              </ul>
          @else
              <p>No ingredients found.</p>
          @endif
</div>
