<?php

namespace App\Services\Payment\PaymentGateways;

use Illuminate\Support\Facades\Http;

class PayTabsGateway implements PaymentGatewayInterface
{
    public function processPayment($order, $gatewayData)
    {
        $response = Http::withHeaders([
            'authorization' => "Bearer " . $gatewayData['key'],
        ])->post('https://secure.paytabs.com/payment/request', [
            'profile_id' => $gatewayData['key'],
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => $order->id,
            'cart_currency' => 'SAR',
            'cart_amount' => $order->amount,
        ]);

        return $response->json();
    }
}