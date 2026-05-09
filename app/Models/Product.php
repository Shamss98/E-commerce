<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount',
        'image',
        'status',
        'stock',
        'min_stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function movements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function getDiscountedPriceAttribute()
    {
        $price = $this->price;
        $discount = $this->discount;

        if ($discount <= 0) {
            return $price;
        }
        $discountAmount = ($price * $discount) / 100;
        if ($discountAmount >= $price) {
            return 0;
        }
        return $price - $discountAmount;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
