<?php

namespace App\Services\Payment;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Notifications\PaymentSuccessNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class PaymentService
{
    public function handleSuccess($paymentId, $source = 'web')
    {
        // التحقق من الدفع باستخدام API أو Webhook
        $paymentData = $this->verifyPayment($paymentId);

        if ($paymentData && $paymentData['status'] === 'COMPLETED') {
            $orderId = $paymentData['purchase_units'][0]['reference_id'];
            $order = Order::find($orderId);

            if ($order && $order->status !== 'paid') {
                // تحديث حالة الطلب
                $order->status = 'paided';
                $order->payment_id = $paymentId;
                $order->save();

                // حذف السلة والمنتجات التي بداخلها
                $cart = Cart::where('user_id', $order->user_id)->first();
                if ($cart) {
                    $cart->products()->detach();
                    $cart->delete();
                }

                // حفظ تفاصيل الدفع
                Payment::create([
                    'order_id' => $orderId,
                    'payment_id' => $paymentId,
                    'amount' => $paymentData['purchase_units'][0]['amount']['value'],
                    'currency' => $paymentData['purchase_units'][0]['amount']['currency_code'],
                    'status' => $paymentData['status'],
                    'gateway' => 'PayPal',
                ]);

                Notification::send($order->user, new PaymentSuccessNotification($order));

                return [
                    'success' => true,
                    'order' => $order,
                    'message' => 'تم الدفع بنجاح'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'فشلت عملية الدفع أو أنها غير صالحة.'
        ];
    }

    public function handleCancel($orderId)
    {
        $order = Order::find($orderId);

        if ($order && $order->status !== 'paided') {
            $order->status = 'cancelled';
            $order->save();

            // إعادة المخزون
            foreach ($order->products as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = $product->pivot->quantity;
                $inventory = $product->inventory()->where('product_id', $item['product_id'])->first();
                $inventory->deductStock($quantity);
            }

            return [
                'success' => true,
                'message' => 'تم إلغاء الطلب بنجاح.'
            ];
        }

        return [
            'success' => false,
            'message' => 'تعذر إلغاء الطلب أو أنه مدفوع بالفعل.'
        ];
    }

    private function verifyPayment($paymentId)
    {
        // طلب API للتحقق من حالة الدفع
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYPAL_API_KEY'),
        ])->get("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$paymentId}");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}