<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IngredientsUser extends Model
{
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_user');
    }
}