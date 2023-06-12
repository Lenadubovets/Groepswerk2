<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class IngredientController extends Controller
{
    //Combine 2 views
    public function index()
{
    $searchData = $this->search(request());
    $showData = $this->show();

    $ingredients = $searchData['ingredients'];
    $selectedIngredients = $searchData['selectedIngredients'];
    
    // Fetch the updated quantities
    $fridgeListIngredients = $this->show()['fridgeListIngredients'];

    return view('ingredients.index', compact('ingredients', 'selectedIngredients', 'fridgeListIngredients'));
}


    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $ingredients = Ingredient::where('name', 'LIKE', "%$query%")->get();
        } else {
            $ingredients = collect();
        }

        $user = auth()->user();
        $selectedIngredients = $user->selectedIngredients;

        return ['ingredients' => $ingredients, 'selectedIngredients' => $selectedIngredients];
    }

    //Show Items in User's Freego
    public function show()
    {
        $user = auth()->user();
        $fridgeListIngredients = DB::table('ingredient_user')
            ->where('user_id', $user->id)
            ->where('list', 'fridgeList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->select('ingredients.*')
            ->get();

        return ['fridgeListIngredients' => $fridgeListIngredients];

    }
    //Add to Freego
    public function store(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->input('ingredient'));
        $list = $request->input('list');

        $user = auth()->user();


        $existingIngredient = $ingredient->users()->where('user_id', $user->id)->where('list', $list)->first();

        if ($existingIngredient) {
            return redirect()->refresh()->with('message', 'You already have this ingredient in your Freego.');
        }
        $ingredient->users()->attach($user->id, ['list' => $list]);

        return redirect()->refresh()->with('message', 'Ingredient added successfully!');
    }

    public function delete($id)
    {
        $user = auth()->user();
        DB::table('ingredient_user')
            ->where('user_id', $user->id)
            ->where('ingredient_id', $id)
            ->where('list', 'fridgeList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->delete();

        return redirect()->route('ingredients.index')->with('message', 'Ingredient removed successfully!');
    }

    public function updateQuantities(Request $request)
    {
        $quantities = $request->input('quantities');
    
        foreach ($quantities as $ingredientId => $quantity) {
            DB::table('ingredient_user')
                ->where('user_id', auth()->id())
                ->where('ingredient_id', $ingredientId)
                ->update(['quantity' => $quantity]);

        // Store the quantity in the session
        session(['ingredient_quantity_'.$ingredientId => $quantity]);
        }
    
        return redirect()->route('ingredients.index')->with('success', 'Quantities updated successfully!');
    }
    
}
