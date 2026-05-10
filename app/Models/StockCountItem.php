<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCountItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_count_id',
        'item_id',
        'system_quantity',
        'actual_quantity',
        'difference',
        'unit_cost',
        'total_cost'
    ];
}
