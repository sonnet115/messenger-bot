<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name", "parent_id", "shop_id"];

    public function subCategory()
    {
        return $this->hasMany(self::class, 'parent_id')->with('subCategory');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id', 'id')
            ->where('show_in_bot', '=', 1);
    }

}
