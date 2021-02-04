<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'pid')
            ->with('discounts')->with('variantsName');
    }
}
