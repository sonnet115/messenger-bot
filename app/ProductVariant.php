<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['variant_id', 'variant_property_ids', 'product_id'];

}
