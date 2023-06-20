@if ($recipes->isEmpty())
  <p>No favorite recipes found.</p>
@else 
  <ul>
    @foreach($recipes as $recipe)
      <li style="display: flex; justify-content: space-between; align-items: center;">
        <div>
          <span style="color: red;">&hearts;</span>
          
            <a class="hover:text-indigo-600"href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
          
        </div>
        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-xs text-white bg-red-500 hover:bg-red-700 rounded-lg px-2 py-1" data-tippy-content="Remove From Favorites">
            <i class="fa-solid fa-trash"></i>
          </button>
        </form>
      </li>
    @endforeach
  </ul>
@endif

