<?php

namespace App\Models;

use App\Models\OrderDetail;
use App\Models\OrderReturn;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function cancelledOrder()
    {
        return $this->hasOne(CancelledOrder::class);
    }

    public function returnOrders()
    {
        return $this->hasMany(ReturnOrder::class);
    }
}
