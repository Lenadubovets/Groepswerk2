<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ShoppingListController extends Controller
{
    //Show ShoppingList
    public function show()
    {
        $user = auth()->user();
        $shoppingListIngredients = DB::table('ingredient_user')
            ->where('user_id', $user->id)
            ->where('list', 'shoppingList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->select('ingredients.*')
            ->get();

        return view('shoppinglist.index', compact('shoppingListIngredients'));


    }

    //Remove From Shopping List
    public function delete(Request $request)
    {
        //Get the selected ingredients
        $selectedIngredients = $request->input('selectedIngredients');

        //Delete the ingredients from the DB
        DB::table('ingredient_user')
            ->where('list', 'shoppingList')
            ->whereIn('ingredient_id', $selectedIngredients)
            ->delete();

        return redirect()->route('shoppinglist.index')->with('message', 'Selected ingredients have been removed.');
    }

    //Add To Shopping List
    public function store(Request $request, $id)
    {
        // Find the ingredient based on $id
        $ingredient = Ingredient::findOrFail($id);

        $list = 'shoppingList';
        $user = auth()->user();
        $existingIngredient = $ingredient->users()->where('user_id', $user->id)->where('list', $list)->first();

        // If ingredient is not already in the shopping list, add it
        if (!$existingIngredient) {
            $ingredient->users()->attach($user->id, ['list' => $list]);
            $message = 'Ingredient added successfully!';
        } else {
            $message = 'Ingredient is already in the shopping list!';
        }

        // If request is AJAX, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'success' => !$existingIngredient,
            ]);
        } else {
            //For non-AJAX, redirect w/ message
            return redirect()->route('ingredients.index')->with([
                'message' => $message,
                'existingIngredient' => $existingIngredient,
            ]);
        }
    }

}