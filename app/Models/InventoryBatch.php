<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'remaining_quantity',
        'unit_cost',
        'received_at',
    ];
}
