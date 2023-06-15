<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;
   

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
