<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon(Request $request, CouponService $couponService, CartService $cartService)
    {
        $cartTotal = $cartService->subtotal();

        $result = $couponService->apply($request->code, $cartTotal);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        session()->put('coupon', [
            'code'    => $result['coupon']->code,
            'type'    => $result['coupon']->type,
            'value'   => $result['coupon']->value,
            'discount' => $result['discount'],
        ]);

        return back()->with('success', 'Coupon applied');
    }
}
