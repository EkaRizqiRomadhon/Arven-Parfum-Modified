<?php

namespace App\Services;

use App\Models\Checkout;
use App\Services\Gateways\PaymentGatewayInterface;
use App\Services\Gateways\SimulatorGateway;

class PaymentService
{
    protected $gateway;

    public function __construct()
    {
        // Nantinya kita bisa switch ke MidtransGateway di sini berdasarkan config atau env
        // $this->gateway = new \App\Services\Gateways\MidtransGateway();
        
        $this->gateway = new SimulatorGateway();
    }

    public function createPayment(Checkout $order)
    {
        return $this->gateway->createPayment($order);
    }

    public function processPayment(Checkout $order, $paymentType)
    {
        return $this->gateway->processPayment($order, $paymentType);
    }

    public function updateStatus(Checkout $order, $status)
    {
        return $this->gateway->updateStatus($order, $status);
    }
}
