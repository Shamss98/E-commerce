<?php

namespace App\Services\Checkout;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\InventoryMovement;
use App\Notifications\LowStockNotification;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OrderService
{
    public function placeOrder($user, array $data)
    {
        $cartItems = $user->cart->items;

        if ($cartItems->isEmpty()) {
            throw new \Exception('Your cart is empty.');
        }

        return DB::transaction(function () use ($user, $data, $cartItems) {

            $total = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'address' => $data['address'],
                'city' => $data['city'],
                'phone_number' => $data['phone_number'],
            ]);

            foreach ($cartItems as $item) {

                $product = $item->product;

                if ($product->stock < $item->quantity) {
                    throw new \Exception("Quantity of stock unavailable for {$product->name}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                $oldStock = $product->stock;

                $newStock = $oldStock - $item->quantity;

                $product->decrement('stock', $item->quantity);

                if (
                    $oldStock > $product->min_stock &&
                    $newStock <= $product->min_stock
                ) {
                    $admin = User::where('role', 'admin')->first();

                    Notification::send(
                        $admin,
                        new LowStockNotification($product)
                    );
                }

                InventoryMovement::create([
                    'product_id' => $item->product_id,
                    'type' => 'out',
                    'quantity' => $item->quantity,
                    'user_id' => Auth::id(),
                ]);
            }

            $user->cart->items()->delete();

            Notification::send(
                $user,
                new OrderPlacedNotification($order)
            );

            return $order;
        });
    }
}
