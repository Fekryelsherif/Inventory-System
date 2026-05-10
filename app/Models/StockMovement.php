<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
    'item_id',
    'type',
    'quantity',
    'before_quantity',
    'after_quantity',
    'unit_cost',
    'total_cost',
    'reference_id',
    'reference_type'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
