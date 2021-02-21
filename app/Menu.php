<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Menu extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
