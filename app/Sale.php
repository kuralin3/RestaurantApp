<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleDetail;

class Sale extends Model
{
    //
    public function saleDetails() {
        return $this->hasMany(SaleDetail::class);
    }
}
