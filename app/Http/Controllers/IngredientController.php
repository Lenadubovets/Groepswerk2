<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class IngredientController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');

    if ($query) {
        $ingredients = Ingredient::where('name', 'LIKE', "%$query%")->get();
    } else {
        $ingredients = collect(); // Initialize an empty collection
    }

    $selectedIngredients = collect(session('selectedIngredients', []));

    return view('ingredients.search', compact('ingredients', 'selectedIngredients'));
}

    public function addToSelected(Request $request, Ingredient $ingredient)
    {
        $selectedIngredients = collect(Session::get('selectedIngredients', []));
        $selectedIngredients->push($ingredient);
        Session::put('selectedIngredients', $selectedIngredients->all());

        return redirect()->route('ingredients.search');
    }

    public function delete($id)
    {
    // Find ingredient by id
    $ingredient = Ingredient::find($id);

    // Check if ingredient exists
    if (!$ingredient) {
        return Redirect::back()->with('error', 'Ingredient not found');
    }
    // Delete the ingredient
    $ingredient->delete();

    return Redirect::back()->with('message', 'Ingredient deleted successfully');
    }

    public function moveToFridgeList($id)
    {
        // Find ingredient by id
        $ingredient = Ingredient::find($id);

        // Move the ingredient to the fridge list
        $ingredient->list_id = $fridgeList->id;
        $ingredient->save();

            return redirect()->back()->with('message', 'Ingredient moved successfully');
        }
}

   

    







