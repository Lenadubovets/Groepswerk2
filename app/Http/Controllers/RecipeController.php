<?php

namespace App\Http\Controllers;


use Dompdf\Dompdf;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $recipes = Recipe::when($searchQuery, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('instruction', 'like', "%{$search}%");
        })->paginate(6);

        return view('recipes.recipes', compact('recipes'));
    }


    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->load('ingredients');

        //Retrieve User's Selected Ingredients
        $userIngredients = User::find(auth()->id())->selectedIngredients;
        return view('recipes.recipe', compact('recipe', 'userIngredients'));
    }

    public function downloadPDF($id)
    {
        $recipe = Recipe::findOrFail($id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('recipes.recipe_pdf', compact('recipe')));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('recipe.pdf');
    }

    public function search()
    {
        //Retrieve User's Ingredients
        $userIngredients = User::find(auth()->id())->selectedIngredients;

        //Find recipes that have the user's ingredients
        $recipes = DB::table('ingredient_recipe')
            ->select('ingredient_recipe.recipe_id', DB::raw('count(*) as ingredient_count'))
            ->whereIn('ingredient_recipe.ingredient_id', $userIngredients)
            ->groupBy('ingredient_recipe.recipe_id')
            ->orderByDesc('ingredient_count')
            ->get();

        //Get the recipe details based on the recipe ID
        $recipeIds = $recipes->pluck('recipe_id');
        $recipeDetails = Recipe::whereIn('id', $recipeIds)->get();

        //Pass to the view
        return view('recipes.search', ['recipes' => $recipeDetails]);
    }

}