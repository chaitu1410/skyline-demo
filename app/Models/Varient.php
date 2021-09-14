<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function discountedPrice()
    {
        return $this->mrp - $this->totalSaving();
    }

    public function gstAmount()
    {
        return ($this->gst * $this->mrp) / 100;
    }

    public function totalSaving()
    {
        return ($this->discount * $this->mrp) / 100;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    // public function orderProduct()
    // {
    //     return $this->belongsToMany(OrderProduct::class);
    // }
}
