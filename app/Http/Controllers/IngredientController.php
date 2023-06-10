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
    public function index()
    {
        $searchData = $this->search(request());
        $showData = $this->show();

        $ingredients = $searchData['ingredients'];
        $selectedIngredients = $searchData['selectedIngredients'];
        $fridgeListIngredients = $showData['fridgeListIngredients'];

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

    public function addToSelected(Request $request, Ingredient $ingredient)
    {
        $user = auth()->user();

        if ($user->selectedIngredients()->where('ingredients.id', $ingredient->id)->exists()) {
            return redirect()->route('ingredients.search')->with('message', 'You already have this ingredient');
        }

        $user->selectedIngredients()->attach($ingredient->id);

        return redirect()->route('ingredients.search');
    }


    public function delete($id)
    {
        $user = auth()->user();
        $user->selectedIngredients()->detach($id);

        return redirect()->back()->with('message', 'Ingredient removed successfully');
    }


}
// public function moveToFridgeList($id)
// {
//     // Find ingredient by id
//     $ingredient = Ingredient::find($id);

//     // Move the ingredient to the fridge list
//     $ingredient->list_id = $fridgeList->id;
//     $ingredient->save();

//         return redirect()->back()->with('message', 'Ingredient moved successfully');
// }