<?php

namespace App\Jobs;

use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Services\Payment\StripeDirectChargeService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;

class ProcessMonthlySubscription implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(StripeDirectChargeService $stripeChargeService): void
    {
        $payment_gateway = PaymentGateway::first();
        $credentials = json_decode(decrypt($payment_gateway->credentials), true);
        $stripe_secret_key = $credentials['STRIPE_SECRET'];
        
        try {
            // تنفيذ عملية الخصم
            $stripeChargeService->chargeAndTransfer(
                50, // المبلغ بالدولار
                'usd',
                $stripe_secret_key, // توكن صاحب المتجر
                env('SUPER_ADMIN_STRIPE_ACCOUNT_ID') // حساب Super Admin
            );

            $subscription = Subscription::where('next_payment_date', '<=', Carbon::now())->where('status', true)->first();

            // تحديث تاريخ الدفع القادم
            $subscription->update(['next_payment_date' => Carbon::now()->addMonth()]);

        } catch (\Exception $e) {
            // // إذا فشلت العملية يتم إيقاف المتجر
            Artisan::call('down', [
                '--secret' => 'super-secret-key', // مفتاح لتجاوز وضع الصيانة
                '--message' => 'تم تعطيل الموقع بسبب فشل عملية الدفع.',
            ]); // الان بتظهر للمستخدمين صفحة الصيانة

            //Or
            // $subscription->update(['status' => false]);
            // $subscription->store->update(['status' => false]); // تعطيل المتجر
        }
    }
}
