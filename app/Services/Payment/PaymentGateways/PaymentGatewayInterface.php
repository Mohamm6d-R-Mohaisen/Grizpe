<?php

namespace App\Services\Payment\PaymentGateways;

interface PaymentGatewayInterface
{
    public function processPayment($order, $gateway_data);
}