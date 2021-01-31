<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariantProperty extends Model
{
    protected $fillable = ['vid', 'property_name', 'description'];
}
