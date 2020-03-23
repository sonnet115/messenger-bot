<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ["fb_id", "first_name", "last_name", "profile_pic", "contact", "shipping_address", "billing_address"];
}
