<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_cart',
        'max_discount',
        'expires_at',
        'usage_limit',
        'usage_count',
        'status',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'status' => 'boolean',
    ];
}
