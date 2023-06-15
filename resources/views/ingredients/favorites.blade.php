
  <h1>My Favorite Recipes</h1>

  @if ($recipes->isEmpty())
    <p>No favorite recipes found.</p>
  @else 
    <ul>
      @foreach($recipes as $recipe)
        <li>
          <a href="/recipe/{{$recipe->id}}">{{$recipe->name}}</a>
        </li>
      @endforeach
    </ul>
  @endif


