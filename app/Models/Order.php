<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'total',
        'total_cost',
        'profit',
        'status',    
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}