<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{

    public function index()
    {
        $ingredients = Recipe::all();
        return view('recipes', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Load the ingredients associated with the recipe
        $recipe->load('ingredients');

        return view('recipe', compact('recipe'));
    }
}
