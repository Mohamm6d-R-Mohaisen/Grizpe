<?php

namespace App\Services\Payment\PaymentGateways;

use Illuminate\Support\Facades\Http;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeGateway implements PaymentGatewayInterface
{
    public function processPayment($order, $gatewayData)
    {
        // إعداد مفاتيح Stripe
        Stripe::setApiKey($gatewayData['secret']);

        // إنشاء جلسة دفع
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'sar',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => $order->total * 100, // Stripe uses cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);

        // إعادة الرابط إلى صفحة الدفع
        return [
            'status' => 'success',
            'redirect_url' => $session->url,
        ];
    }
}
