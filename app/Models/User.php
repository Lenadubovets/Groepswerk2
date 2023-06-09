<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Recipe;
use App\Models\Ingredient;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class User extends Authenticatable
class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_user', 'user_id', 'ingredient_id')
            ->withPivot('list', 'quantity');
    }

    public function sharedShoppingLists()
    {
        return $this->hasMany(SharedShoppingList::class);
    }

    //Get User's Freego Items
    public function getFridgeListIngredients()
    {
        return DB::table('ingredient_user')
            ->where('user_id', $this->id)
            ->where('list', 'fridgeList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->pluck('ingredients.id');
    }

    //Get User's Shopping List Items
    public function getShoppingListIngredients()
    {
        return DB::table('ingredient_user')
            ->where('user_id', $this->id)
            ->where('list', 'shoppingList')
            ->join('ingredients', 'ingredient_user.ingredient_id', '=', 'ingredients.id')
            ->pluck('ingredients.id');
    }

    public function favoriteRecipes()
    {
        return $this->belongsToMany(Recipe::class);
    }


}