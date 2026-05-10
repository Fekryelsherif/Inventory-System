<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeItem extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'item_id', 'quantity'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
