<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function apply($code, $cartTotal)
{
    $coupon = Coupon::where('code', strtoupper($code))
        ->where('status', 1)
        ->first();

    if (!$coupon) {
        return ['success' => false, 'message' => 'Invalid coupon'];
    }

    if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
        return ['success' => false, 'message' => 'Coupon expired'];
    }

    if ($coupon->usage_limit && $coupon->used >= $coupon->usage_limit) {
        return ['success' => false, 'message' => 'Coupon limit reached'];
    }

    if ($coupon->min_cart && $cartTotal < $coupon->min_cart) {
        return ['success' => false, 'message' => 'Minimum cart not reached'];
    }

    if ($coupon->type === 'fixed') {
        $discount = $coupon->value;
    } else {
        $discount = ($cartTotal * $coupon->value) / 100;
    }

    if ($coupon->max_discount) {
        $discount = min($discount, $coupon->max_discount);
    }

    $discount = min($discount, $cartTotal);
    // $coupon->increment('used');

    return [
        'success' => true,
        'coupon' => $coupon,
        'discount' => $discount
    ];
}
}

