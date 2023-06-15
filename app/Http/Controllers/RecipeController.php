<?php

namespace App\Http\Controllers;


use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Recipe;
use Barryvdh\DomPDF\PDF;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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
        $userFridgeListIngredients = auth()->user()->getFridgeListIngredients();
        $userShoppingListIngredients = auth()->user()->getShoppingListIngredients();

        //Sort the ingredients
        $sortedIngredients = $recipe->ingredients->sortBy(function ($ingredient) use ($userShoppingListIngredients, $userFridgeListIngredients){
            if ($userShoppingListIngredients->contains($ingredient->id)){
                return 1;
            } elseif ($userFridgeListIngredients->contains($ingredient->id)){
                return 0;
            } else {
                return 2;
            }
        });

        return view('recipes.recipe', compact('recipe', 'sortedIngredients', 'userShoppingListIngredients', 'userFridgeListIngredients'));
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
    // Like recipe and push this to list with favorites recipes
    public function like(Recipe $recipe)
    {
        $user = auth()->user();

        // Check if the recipe is already in the favorite list
        if ($user->favoriteRecipes()->where('recipe_id', $recipe->id)->exists()) {
          return back()->with('message', 'Recipe is already in favorites.');
        }

         // Attach the recipe to the favorite list
        $user->favoriteRecipes()->attach($recipe);

        return back()->with('message', 'Recipe added to favorites.');
    }


    //delete from favorites
    public function destroy(Recipe $recipe)
    {
        // Detach the recipe from the authenticated user's favoriteRecipes relationship
        auth()->user()->favoriteRecipes()->detach($recipe);
    
        return redirect()->back()->with('message', 'Recipe removed from favorites.');
    }
    

    public function search()
    {

        //Retrieve User's Ingredients
        $userIngredients = auth()->user()->getFridgeListIngredients();



        // Find recipes that have the user's ingredients
        $recipes = DB::table('ingredient_recipe')
            ->select('ingredient_recipe.recipe_id', DB::raw('count(*) as ingredient_count'))
            ->whereIn('ingredient_recipe.ingredient_id', $userIngredients)
            ->groupBy('ingredient_recipe.recipe_id')
            ->orderByDesc('ingredient_count')
            ->get();

        // Get the recipe details based on the recipe ID
        $recipeIds = $recipes->pluck('recipe_id')->toArray();

        // Get recipes in the order of $recipeIds
        if (!empty($recipeIds)) {
            $recipeDetails = Recipe::whereIn('id', $recipeIds)
                ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $recipeIds) . ")"))
                ->get();
        } else {
            $recipeDetails = collect(); // Return an empty collection if no recipes match
        }

        // Pass to the view
        return view('recipes.search', ['recipes' => $recipeDetails, 'userIngredients' => $userIngredients]);
    }


}