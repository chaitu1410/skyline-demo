<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

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

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function varients()
    {
        return $this->hasMany(Varient::class);
    }

    // public function orderProduct()
    // {
    //     return $this->belongsToMany(OrderProduct::class);
    // }
}
