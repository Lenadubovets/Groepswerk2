@extends('layout')
@section('content')
    <div class="div bg-gray-50 border border-gray-200 rounded p-10 rounded max-w-lg mx-auto mt-24">
        <h1>User Shopping List Ingredients:</h1>
        @foreach ($shoppingListIngredients as $ingredient)
            <form action="{{ route('shoppinglist.remove', $ingredient->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <p>{{ $ingredient->name }}</p>
                <button type="submit">Remove</button>
            </form>
        @endforeach
    @endsection
</div>
