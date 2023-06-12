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
    public function delete($ingredientId)
    {
        $user = auth()->user();
        DB::table('ingredient_user')
            ->where('user_id', $user->id)
            ->where('ingredient_id', $ingredientId)
            ->where('list', 'shoppingList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->delete();

        return redirect()->route('shoppinglist.index')->with('message', 'Ingredient removed successfully!');
    }

    //Add To Shopping List
    public function store(Request $request, $id)
    {
        //Find the ingredient based on $id
        $ingredient = Ingredient::findOrFail($id);

        $list = 'shoppingList';

        $user = auth()->user();

        $existingIngredient = $ingredient->users()->where('user_id', $user->id)->where('list', $list)->first();

        if ($existingIngredient) {
            return redirect()->route('ingredients.index')->with('message', 'You already have this ingredient in your Shopping List.');
        }

        $ingredient->users()->attach($user->id, ['list' => $list]);

        return redirect()->route('shoppinglist.index')->with('message', 'Ingredient added successfully!');
    }
}