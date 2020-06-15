<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function menus(){
        return $this->belongsToMany(Menu::class, 'role_menu_mappings', 'role_id', 'menu_id');
    }
}
