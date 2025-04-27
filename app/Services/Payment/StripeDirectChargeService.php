<?php

namespace App\Services\Payment;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Notifications\PaymentSuccessNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Stripe\Charge;
use Stripe\Stripe;

class StripeDirectChargeService
{
    /**
     * Charges a merchant's card and transfers the funds to the super admin account
     */
    public function chargeAndTransfer($amount, $currency, $customerStripeToken, $adminStripeAccountId)
    {
        // إعداد Stripe بمفتاح الـ Super Admin
        Stripe::setApiKey(env('SUPER_ADMIN_STRIPE_SECRET'));

        try {
            // إنشاء دفعة
            $charge = Charge::create([
                'amount' => $amount * 100, // Stripe يستخدم السنتات
                'currency' => $currency,
                'source' => $customerStripeToken, // توكن العميل
                'description' => 'Subscription fee for store setup',
                'transfer_data' => [
                    'destination' => $adminStripeAccountId,
                ],
            ]);

            return $charge;
        } catch (\Exception $e) {
            throw new \Exception("Stripe Charge Error: " . $e->getMessage());
        }
    }
}