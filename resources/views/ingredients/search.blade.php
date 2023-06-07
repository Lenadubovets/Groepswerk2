@extends('layout')
@section('content')

<h1>Your FREEGO Ingredients</h1>

<form action="{{ route('ingredients.search') }}" method="GET">
    <input type="text" name="query" placeholder="Search for ingredients...">
    <button type="submit">Search</button>
</form>

@if ($ingredients->count() > 0)
    <h2>Search Results</h2>
    <ul>
        @foreach ($ingredients as $ingredient)
            <li>
                {{ $ingredient->name }}
                <form action="{{ route('ingredients.addToSelected', $ingredient) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Add to List</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>No ingredients found.</p>
@endif

@if ($selectedIngredients->count() > 0)
    
    <table>
        <thead>
            <tr>
                <th><h2> FREEGO List</h2></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($selectedIngredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <a href="{{ route('ingredient.moveToFridgeList', $ingredient->id) }}">
                        <button class="text-xs text-white bg-blue-500 hover:bg-blue-700 rounded-lg px-2 py-1">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </a>
                    <form action="{{ route('ingredient.delete', ['id' => $ingredient->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-xs text-white bg-red-500 hover:bg-red-700 rounded-lg px-2 py-1" type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No ingredients added to the list.</p>
@endif

@endsection

