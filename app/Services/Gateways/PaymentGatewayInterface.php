<?php

namespace App\Services\Gateways;

use App\Models\Checkout;

interface PaymentGatewayInterface
{
    public function createPayment(Checkout $order): string;
    public function processPayment(Checkout $order, string $paymentType): bool;
    public function updateStatus(Checkout $order, string $status): Checkout;
}
