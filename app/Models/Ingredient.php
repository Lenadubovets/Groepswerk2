<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
 further-with-delete/add
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ingredients_user');
    }
}

    use HasFactory;
    
    protected $table = 'ingredients';
    public function recipes()
{
    return $this->belongsToMany(Recipe::class, 'ingredient_recipe', 'ingredient_id', 'recipe_id');
}


 
}

