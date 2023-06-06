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
}
