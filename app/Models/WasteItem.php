<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_id',
        'item_id',
        'quantity',
        'unit_cost',
        'total_cost'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
