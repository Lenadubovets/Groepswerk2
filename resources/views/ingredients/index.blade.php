@extends('layout')
@section('content')

<div class="mx-auto max-w-2xl p-6 bg-white rounded-lg">
    <h1 class="text-2xl font-bold mb-6 ml-6">Your FREEGO ingredients here</h1>
    <div class="flex justify-center mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="text-center text-xl font-bold">Ingredients</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIngredients = count($ingredients);
                    $halfCount = ceil($totalIngredients / 2);
                @endphp

                @for ($i = 0; $i < $halfCount; $i++)
                    <tr>
                        <td class="border-b">
                            {{ $ingredients[$i]->name }}
                            <a href="{{ route('ingredient.moveToFridgeList', $ingredients[$i]->id) }}"> <button>Move</button></a>
                            <form action="{{ route('ingredient.delete', ['id' => $ingredients[$i]->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                        <td class="border-b">
                            @if ($i + $halfCount < $totalIngredients)
                                {{ $ingredients[$i + $halfCount]->name }}
                                <a href="{{ route('ingredient.moveToFridgeList', $ingredients[$i]->id) }}"> <button>Move</button></a>
                                <form action="{{ route('ingredient.delete', ['id' => $ingredients[$i + $halfCount]->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>


@endsection