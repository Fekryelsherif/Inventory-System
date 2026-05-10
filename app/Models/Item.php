<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'price',
        'category_id',
        'unit_id',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stock_movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

   public function getImageAttribute($value)
{
    if (!$value) return null;

    if (str_starts_with($value, 'http')) {
        return $value;
    }

    return asset('storage/' . $value);
}
}