<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
{
    $ingredients = Ingredient::all();
    return view('ingredients.index', compact('ingredients'));
}

}
