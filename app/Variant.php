<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = ['name', 'user_id'];

    function variantProperties()
    {
        return $this->hasMany(VariantProperty::class, 'vid', 'id');
    }

    function variantPropertiesName()
    {
        return $this->belongsToMany(VariantProperty::class,ProductVariant::class, 'variant_id', 'variant_property_ids')
            ->withPivot('product_id');
    }
}
