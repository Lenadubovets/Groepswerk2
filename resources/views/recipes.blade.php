<h1>List of Recipes</h1>

<ul>
    @foreach($recipes as $recipe)
        <li>{{ $recipe->name }}</li>
    @endforeach
</ul>
