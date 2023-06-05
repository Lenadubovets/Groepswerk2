<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = DB::table('recipes')->get();

        return view('recipes', ['recipes' => $recipes]);
    }
}
