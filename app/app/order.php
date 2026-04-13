<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
