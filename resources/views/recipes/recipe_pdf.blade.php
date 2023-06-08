<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16">
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">{{ $recipe->name }}</h1>
        <p class="text-lg font-semibold">Instructions:</p>
        <p class="text-lg">{{ $recipe->instruction }}</p>

        @if ($recipe->ingredients->count() > 0)
            <p class="text-lg font-semibold mt-8">Ingredients:</p>
            <ul class="list-disc ml-8 mt-2">
                @foreach ($recipe->ingredients as $ingredient)
                    <li class="text-base">{{ $ingredient->name }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-lg">No ingredients found.</p>
        @endif
    </div>
</body>
</html>

