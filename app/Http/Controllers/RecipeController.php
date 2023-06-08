<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{

    // public function index()
    // {
    //     $recipes = Recipe::all();
    //     return view('recipes.recipes', compact('recipes'));
    // }
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $recipes = Recipe::when($searchQuery, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('instruction', 'like', "%{$search}%");
        })->get();

        return view('recipes.recipes', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->load('ingredients');
        return view('recipes.recipe', compact('recipe'));
    }
    

 
}
