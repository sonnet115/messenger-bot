<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['pid', 'customer_id', 'product_qty', 'subtotal'];
}
