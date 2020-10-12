<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'stock', 'uom', 'price'];

    public function discounts()
    {
        return $this->hasOne(Discount::class, 'pid', 'id')
            ->where('dis_from', '<=', date("Y-m-d"))
            ->where('dis_to', '>=', date("Y-m-d"))
            ->where('state', '=', 1);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'pid', 'id');
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
