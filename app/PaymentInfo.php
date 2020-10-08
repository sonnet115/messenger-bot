<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $fillable = [
        'page_id', 'page_name', 'month', 'trx_id',
    ];
}
