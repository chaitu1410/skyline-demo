<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function varient()
    {
        return $this->belongsTo(Varient::class);
    }
}
