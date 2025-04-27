<?php

namespace App\Services\Payment\PaymentGateways;

use Illuminate\Support\Facades\Http;

class PayPalGateway implements PaymentGatewayInterface
{
    public function processPayment($order, $gatewayData)
    {
        // URL الخاص بـ PayPal (Sandbox أو Production)
        $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders"; // استخدم "api-m.paypal.com" للإنتاج

        // الخطوة 1: إنشاء طلب
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $gatewayData['key'],
            'Content-Type' => 'application/json',
        ])->post($url, [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $order->id,
                    'amount' => [
                        'currency_code' => 'USD', // العملة
                        'value' => $order->amount, // المبلغ
                    ],
                ],
            ],
            'application_context' => [
                'return_url' => route('api.v1.payment.success'),
                'cancel_url' => route('api.v1.payment.cancel'),
            ],
        ]);

        // التحقق من الرد
        if ($response->successful()) {
            $result = $response->json();

            // إرجاع رابط الدفع
            return [
                'status' => 'success',
                'redirect_url' => $result['links'][1]['href'], // رابط الدفع
            ];
        }

        return ['status' => 'error', 'message' => 'PayPal Payment failed'];
    }
}
