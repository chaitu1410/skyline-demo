<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrderProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function returnOrder()
    {
        return $this->belongsTo(ReturnOrder::class);
    }

    public function orderProduct()
    {
        return $this->hasOne(OrderProduct::class, 'id', 'order_product_id');
    }
}
