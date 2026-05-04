<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    protected $apiKey;
    protected $integrationId;
    protected $iframeId;

    public function __construct()
    {
        $this->apiKey = config('services.paymob.api_key');
        $this->integrationId = config('services.paymob.integration_id');
        $this->iframeId = config('services.paymob.iframe_id');
    }

    public function getAuthToken()
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => $this->apiKey,
        ]);

        $data = $response->json();

        if (!isset($data['token'])) {
            throw new \Exception('Paymob Auth Error: ' . json_encode($data));
        }

        return $data['token'];
    }

    public function createOrder($token, $amount, $merchantOrderId)
    {
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', [
            'auth_token' => $token,
            'delivery_needed' => false,
            'amount_cents' => (int)($amount * 100),
            'currency' => 'EGP',
            'merchant_order_id' => $merchantOrderId,
            'items' => [],
        ]);

        $data = $response->json();

        if (!isset($data['id'])) {
            throw new \Exception('Paymob Order Error: ' . json_encode($data));
        }

        return $data['id'];
    }

    public function getPaymentKey($token, $amount, $orderId, $user, $order)
    {
        $name = $user->name ?? 'User Test';
        $parts = explode(' ', $name);

        $firstName = $parts[0] ?? 'User';
        $lastName  = $parts[1] ?? 'Test';

        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'amount_cents' => (int)($amount * 100),
            'order_id' => $orderId,
            'currency' => 'EGP',
            'billing_data' => [
                "first_name" => $firstName,
                "last_name" => $lastName,
                "email" => $user->email ?? 'test@test.com',
                "phone_number" => $order->phone_number ?? '01000000000',
                "apartment" => "NA",
                "floor" => "NA",
                "street" => $order->address ?? 'NA',
                "building" => "NA",
                "shipping_method" => "NA",
                "postal_code" => "00000",
                "city" => $order->city ?? 'Cairo',
                "country" => "EG",
                "state" => "NA",
            ],
            'integration_id' => $this->integrationId,
        ]);

        $data = $response->json();

        if (!isset($data['token'])) {
            throw new \Exception('Paymob PaymentKey Error: ' . json_encode($data));
        }

        return $data['token'];
    }

    public function getPaymentUrl($paymentToken)
    {
        return "https://accept.paymob.com/api/acceptance/iframes/"
            . $this->iframeId
            . "?payment_token=" . $paymentToken;
    }
    public function getOrder($orderId)
    {
        $response = Http::get('https://accept.paymob.com/api/ecommerce/orders/' . $orderId);

        if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Failed to fetch order from Paymob',
            'error' => $response->body(),
        ];
    }

    return [
        'success' => true,
        'data' => $response->json(),
    ];
    }
}
