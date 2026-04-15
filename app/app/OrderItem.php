<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'amount',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
