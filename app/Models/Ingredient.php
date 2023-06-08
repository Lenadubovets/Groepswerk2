<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';


    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ingredient_user', 'ingredient_id', 'user_id');
    }
    

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe', 'ingredient_id', 'recipe_id');
    }

}


 





