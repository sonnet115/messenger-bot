<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['pid', 'customer_id', 'product_qty', 'subtotal'];

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'pid');
    }

    public function customers()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
