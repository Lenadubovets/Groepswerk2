<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;


use Illuminate\Http\Request;
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


Route::get('/recipes', [RecipeController::class, 'index']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// GET all ingredients
Route::get('/products', [IngredientController::class, 'index']);

//Add to shopping list
Route::get('/ingredient/{id}/fridgelist', [IngredientController::class, 'moveToFridgelist'])->name('ingredient.moveToFridgeList');

// //Delete ingredients 
Route::delete('/ingredient/{id}/delete', [IngredientController::class, 'delete'])->name('ingredient.delete');



// // GET ingredient by name
// Route::get('/products/{name}', function ($name) {
//     $ingredient = Ingredient::where('name', $name)->get();
//     return $ingredient;
// });