<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['name', 'from', 'to', 'pid', 'dis_percentage', 'max_customers'];
}
