<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['output_item_id', 'output_quantity'];

    public function items()
    {
        return $this->hasMany(RecipeItem::class);
    }

    public function output()
    {
        return $this->belongsTo(Item::class, 'output_item_id');
    }
}
