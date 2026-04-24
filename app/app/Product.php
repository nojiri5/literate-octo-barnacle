<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    protected $fillable = ['user_id','name','amount','image','description'];


public function reviews()
{
    return $this->hasMany(\App\Review::class);
}

}