<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\List;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IngredientController extends Controller
{
    public function index()
{
    $ingredients = Ingredient::all();
    return view('ingredients.index', compact('ingredients'));
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







