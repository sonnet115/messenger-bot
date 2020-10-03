<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = "pages";
    protected $fillable = [
        'page_name', 'page_id', 'page_access_token', 'page_owner_id', 'page_contact', 'page_likes', 'is_published', 'is_webhooks_subscribed', 'page_username',
        'page_address', 'page_web_link', 'page_connected_status'
    ];

    function billing()
    {
        return $this->hasMany(Billing::class, 'page_id', 'id');
    }
}
