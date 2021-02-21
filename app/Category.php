<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;

class Category extends Model
{
    public function menus() {
        return $this->hasMany(Menu::class);
    }
}
