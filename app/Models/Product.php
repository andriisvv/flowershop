<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'category_id', 'name', 'description',
    'price', 'discount', 'stock', 'is_active', 'image'
];
    protected $attributes = [
    'is_active' => true,
    'discount'  => 0,
];
public function getDiscountedPriceAttribute()
{
    if ($this->discount > 0) {
        return $this->price * (1 - $this->discount / 100);
    }
    return $this->price;
}

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}