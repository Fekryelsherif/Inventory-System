<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    protected $table = 'grns';

    protected $fillable = [
        'purchase_order_id',
    ];

    public function items()
    {
        return $this->hasMany(GrnItem::class);
    }

    // purchase item
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
