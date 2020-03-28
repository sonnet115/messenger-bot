<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ["fb_id", "first_name", "last_name", "profile_pic", "contact", "shipping_address", "billing_address"];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders', 'customer_id', 'pid')
            ->withPivot('product_qty', 'product_price', 'subtotal', 'created_at');
    }
}
