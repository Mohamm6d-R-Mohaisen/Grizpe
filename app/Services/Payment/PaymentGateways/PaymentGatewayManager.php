<?php

namespace App\Services\Payment\PaymentGateways;

class PaymentGatewayManager
{
    protected $gateways = [
        // 'PayTabs' => PayTabsGateway::class,
        // 'PayPal' => PayPalGateway::class, 
        // 'Telr' => TelrGateway::class, 
        'Stripe' => StripeGateway::class,
    ];

    public function getGateway($gatewayName)
    {
        if (!array_key_exists($gatewayName, $this->gateways)) {
            throw new \Exception("Gateway not supported");
        }
        
        $gatewayClass = $this->gateways[$gatewayName];
        return new $gatewayClass();
    }
}
