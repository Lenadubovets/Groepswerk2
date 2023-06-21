<?php

use App\Models\Recipe;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SharedShoppingListController;
use App\Http\Controllers\ShoppingListController;
use TCG\Voyager\Facades\Voyager;


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
    // If user is logged in and has the admin role, redirect to the Voyager admin panel
    if (auth()->check() && auth()->user()->role_id === 1) {
        return redirect(route('voyager.dashboard'));
    } else {
        // If user is logged in, redirect to their Freego
        if (auth()->check()) {
            return redirect()->route('ingredients.index');
        } else {
            // Show generic welcome message to guests
            return view('welcome');
        }
    }
});

//get all recipes

Route::get('/recipes', [RecipeController::class, 'index'])
    ->middleware('auth')
    ->name('recipes.index');


//single recipe
Route::get('/recipe/{id}', [RecipeController::class, 'show'])
    ->name('recipes.show');

//pdf
Route::get('/recipes/{id}/download', [RecipeController::class, 'downloadPDF'])
    ->middleware('auth')
    ->name('recipes.download');

//like recipe

Route::post('/recipes/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');

//delete recipe from list of favorites
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');


//Search for recipes based on ingredients
Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search')->middleware('auth');

//add ingredients to recipe
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Search ingredients
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index')->middleware('auth');

//Store ingredients
Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');

//Delete ingredients
Route::delete('/ingredients/{id}', [IngredientController::class, 'delete'])->name('ingredients.delete');

//Show Shopping List
Route::get('/shoppinglist', [ShoppingListController::class, 'show'])->name('shoppinglist.index')->middleware('auth');

//Remove From Shopping List
Route::delete('/shoppinglist', [ShoppingListController::class, 'delete'])->name('shoppinglist.remove')->middleware('auth');

//Make a SharedShoppingList Link
Route::post('/shoppinglist/share', [SharedShoppingListController::class, 'share']);

//Show Shared Shopping List
Route::get('/sharedshoppinglist/{shareable_link}', [SharedShoppingListController::class, 'show'])
    ->name('sharedShoppingList.show')
    ->middleware('signed');

//Add To Shopping List
Route::post('/shoppinglist/{id}', [ShoppingListController::class, 'store'])->name('shoppinglist.store')->middleware('auth');

//Quantity ingredients
Route::post('/ingredients/quantities', [IngredientController::class, 'updateQuantities'])->name('updateQuantities');

//more.blade
Route::get('/more', function () {
    return view('more');
});

//Show register form
Route::get('/register', [UserController::class, 'create']);

//Create New User
Route::post('/users', [UserController::class, 'store']);


//Logout
Route::post('/logout', [UserController::class, 'logout']);

//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login');

//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Show User Profile
Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth');

//Update User Name
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('update.profile')->middleware('auth');