<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
