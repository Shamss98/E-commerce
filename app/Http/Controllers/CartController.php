<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
{
    $cart = $this->cart->getCart();
    $subtotal = $this->cart->subtotal();
    $tax = $subtotal * 0.1;
    $shipping = $subtotal > 0 ? 5 : 0;

    $total = $subtotal + $tax + $shipping;

    $finalTotal = $total;

    $coupon = session('coupon');

$finalTotal = $total;

if ($coupon) {

    if ($coupon['type'] === 'fixed') {
        $finalTotal -= $coupon['value'];
    }

    if ($coupon['type'] === 'percentage') {
        $finalTotal -= ($total * ((float) $coupon['value'] / 100));
    }

    $finalTotal = max(0, $finalTotal);
}

$discount = $total - $finalTotal;

    return view('frontend.cart.index', compact(
        'cart',
        'subtotal',
        'tax',
        'total',
        'shipping',
        'finalTotal',
        'discount'
    ));
}

    public function add($id)
    {

        $this->cart->add($id);
        return back()->with('success', 'Added to cart');
    }

    public function update(Request $request, $id)
    {
        $this->cart->update($id, $request->quantity);
        return back();
    }

    public function remove($id)
    {
        if (session('coupon')) {
            session()->forget('coupon');
        }
        $this->cart->remove($id);
        return back();
    }
}
