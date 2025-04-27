<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use App\Models\PaymentGatewayTranslation;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_gateways = [
            [
                'id' => 1,
                'payment_gateway_id' => 1,
                'status' => 1,
                'name_ar' => 'سترايب',
                'name_en' => 'Stripe',
                'description_ar' => 'لوريم اسبازوم',
                'description_en' => 'Loream ispazom',
                'credentials' => json_encode([
                    'STRIPE_KEY' => 'pk_test_51Qggow08bBkKfEj1fZkS6hvMrUDPZ2VHK31gYBHKiuv0KOoKoNrAn7DehJDrU69KiZeGYOtipUPTXWUL9FLm8fn0006pmrxDrV',
                    'STRIPE_SECRET' => 'sk_test_51Qggow08bBkKfEj1ZZMJWEn4d6KcfFn1Rxp7YdUB9WyLxoqLZZZ1AdBUcRYlNdsadt3KceqxIviWVCWXo096dcmA00DSG8J1bU',
                ]),
            ],
        ];

        foreach ($payment_gateways as $payment_gateway) {
            $this->seedPaymentGateway($payment_gateway);
        }
    }

    public static function seedPaymentGateway($payment_gateway) 
    {
        $new_payment_gateway = PaymentGateway::firstOrCreate([
            'id' => $payment_gateway['id'],
            'credentials' => $payment_gateway['credentials'],
            'status' => $payment_gateway['status']
        ]);
        foreach (['ar','en'] as $key) {
            PaymentGatewayTranslation::firstOrCreate([
                'payment_gateway_id' => $new_payment_gateway->id,
                'name' => $payment_gateway['name_' . $key],
                'description' => $payment_gateway['description_' . $key],
                'locale' => $key,
            ]);
        }
        return true;
    }
}
