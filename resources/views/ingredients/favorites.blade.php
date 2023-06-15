@if ($recipes->isEmpty())
  <p>No favorite recipes found.</p>
@else 
  <ul>
    @foreach($recipes as $recipe)
      <li style="display: flex; justify-content: space-between; align-items: center;">
        <div>
          <span style="color: red;">&hearts;</span>
          <a href="/recipe/{{$recipe->id}}">{{$recipe->name}}</a>
        </div>
        <button class="text-xs text-white bg-red-500 hover:bg-red-700 rounded-lg px-2 py-1" onclick="">
          <i class="fa-solid fa-trash"></i>
        </button>
      </li>
    @endforeach
  </ul>
@endif
