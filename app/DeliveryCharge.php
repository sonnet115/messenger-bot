<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    public function shop(){
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }
}
