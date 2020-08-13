<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['name', 'from', 'to', 'pid', 'dis_percentage', 'max_customers'];

    function product(){
        return $this->belongsTo(Product::class, 'pid');
    }

    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
