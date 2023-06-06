<?php

use App\Models\Recipe;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//get all recipes

Route::get('/recipes', function () {
    return view('recipes',[
        'recipes' =>Recipe::all()
    ]);
});

//single recipe
Route::get('/recipe/{id}', function ($id) {
    $recipe = Recipe::find($id);
    return view('recipe', compact('recipe'));
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// GET all ingredients
Route::get('/products', [IngredientController::class, 'index']);

// // GET ingredient by name
// Route::get('/products/{name}', function ($name) {
//     $ingredient = Ingredient::where('name', $name)->get();
//     return $ingredient;
// });