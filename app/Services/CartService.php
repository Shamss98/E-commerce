<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
  public function getCart()
{
    $userId = Auth::id();

    return Cart::firstOrCreate([
        'user_id' => $userId,
    ]);
}

    public function add($productId)
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $price = $product->discount > 0
                ? $product->discounted_price
                : $product->price;

            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $price,
            ]);
        }
    }

    public function update($itemId, $quantity)
    {
        $item = $this->getCart()->items()->findOrFail($itemId);

        if ($quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $quantity]);
        }
    }

    public function remove($itemId)
    {
        $this->getCart()->items()->findOrFail($itemId)->delete();
    }

    public function subtotal()
{
    return $this->getCart()->items->map(fn($item) => $item->quantity * $item->price)->sum();
}

public function tax()
{
    return $this->subtotal() * 0.14;
}

public function shipping()
{
    return 10;
}

public function total()
{
    return $this->subtotal() + $this->tax() + $this->shipping();
}
}
