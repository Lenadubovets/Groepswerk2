<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// // GET all ingredients
// Route::get('/', function () {
//     $ingredients = Ingredient::all();
//     return $ingredients;
// });

// // GET ingredient by name
// Route::get('/{name}', function ($name) {
//     $ingredient = Ingredient::where('name', $name)->get();
//     return $ingredient;
// });