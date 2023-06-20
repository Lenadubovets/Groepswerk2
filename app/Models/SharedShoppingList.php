<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class SharedShoppingList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shareable_link', 'items'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}