<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout.index');
    }
    public function placeOrder(Request $request)
    {

        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $cartItems = $user->cart->items;

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {

            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->price * $item->quantity;
            }


            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $total,
                'address' => $request->address,
                'city'    => $request->city,
                'phone_number' => $request->phone_number
            ]);


            foreach ($cartItems as $item) {

                if ($item->product->stock < $item->quantity) {
                    throw new \Exception(" quantity of stock " . $item->product->name);
                }


                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ]);


                $item->product->decrement('stock', $item->quantity);
            }


            $user->cart->items()->delete();


            DB::commit();


            Notification::send($user, new OrderPlacedNotification($order));

        return redirect()->route('payment.pay', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
