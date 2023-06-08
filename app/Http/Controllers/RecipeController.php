<?php

namespace App\Http\Controllers;


use Dompdf\Dompdf;
use App\Models\Recipe;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $recipes = Recipe::when($searchQuery, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('instruction', 'like', "%{$search}%");
        })->paginate(6);

        return view('recipes.recipes', compact('recipes'));
    }


    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->load('ingredients');
        return view('recipes.recipe', compact('recipe'));
    }

    public function downloadPDF($id)
    {
        $recipe = Recipe::findOrFail($id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('recipes.recipe_pdf', compact('recipe')));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('recipe.pdf');
    }

    

}
