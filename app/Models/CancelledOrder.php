<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledOrder extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function order()
    {
        return $this->belongTo(Order::class);
    }
}
