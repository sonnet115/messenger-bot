<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['pid', 'customer_id', 'product_qty', 'subtotal'];

    public function ordered_products()
    {
        return $this->belongsToMany(Product::class, OrderedProducts::class, 'oid', 'pid')
               ->withPivot('quantity', 'price', 'discount', 'product_status');
    }


}
