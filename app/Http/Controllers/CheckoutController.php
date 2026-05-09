<?php

namespace App\Http\Controllers;
use App\Services\Checkout\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    protected OrderService $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = new OrderService();
    }
    public function index()
    {
        return view('frontend.checkout.index');
    }
  public function placeOrder(Request $request, OrderService $orderService)
{
    $request->validate([
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
    ]);

    try {

        $order = $orderService->placeOrder(
            Auth::user(),
            $request->only([
                'address',
                'city',
                'phone_number'
            ])
        );

        return redirect()->route('payment.pay', $order->id);

    } catch (\Exception $e) {

        return back()->with('error', $e->getMessage());
    }
}
}
