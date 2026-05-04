<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Checkout\PaymobService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymob;

    public function __construct(PaymobService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();

        $token = $this->paymob->getAuthToken();

        $paymobOrderId = $this->paymob->createOrder(
            $token,
            $order->total,
            $order->id
        );

        $paymentToken = $this->paymob->getPaymentKey(
            $token,
            $order->total,
            $paymobOrderId,
            $user,
            $order
        );

        $url = $this->paymob->getPaymentUrl($paymentToken);

        return redirect()->away($url);
    }
    public function paymobCallback()
    {
        return $this->paymob->getOrder(request('paymentId'));
    }
}
