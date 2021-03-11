<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;

class SaleDetail extends Model
{
    //
    public function sale() {
        return $this->belongsTo(Sale::class);
    }
}
