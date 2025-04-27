<?php

namespace App\Services\Payment\PaymentGateways;

use App\Services\Payment\PaymentGateways\PaymentGatewayInterface;
use Illuminate\Support\Facades\Http;

class TelrGateway implements PaymentGatewayInterface
{
    public function processPayment($order, $gatewayData)
    {
        $response = Http::post('https://secure.telr.com/gateway/order.json', [
            'ivp_method' => 'create',
            'ivp_store' => $gatewayData['key'],
            'ivp_authkey' => $gatewayData['secret'],
            'ivp_cart' => $order->id,
            'ivp_amount' => $order->amount,
            'ivp_currency' => 'SAR', // يمكنك تغييره حسب العملة المطلوبة
            'return_auth' => route('payment.success'),
            'return_can' => route('payment.cancel'),
            'return_decl' => route('payment.cancel'),
        ]);

        $result = $response->json();

        if (isset($result['order']) && isset($result['order']['url'])) {
            return [
                'status' => 'success',
                'redirect_url' => $result['order']['url'],
            ];
        }

        return [
            'status' => 'error',
            'message' => $result['error']['message'] ?? 'Unknown error occurred',
        ];
    }
}
