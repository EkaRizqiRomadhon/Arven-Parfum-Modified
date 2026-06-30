<?php

namespace App\Services\Gateways;

use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SimulatorGateway implements PaymentGatewayInterface
{
    public function createPayment(Checkout $order): string
    {
        $snapToken = 'SIMULATION-' . Str::random(20);

        $order->update([
            'payment_status' => 'pending',
            'snap_token'     => $snapToken,
        ]);

        return $snapToken;
    }

    public function processPayment(Checkout $order, string $paymentType): bool
    {
        $order->update([
            'payment_status' => 'processing',
            'payment_type'   => $paymentType
        ]);

        return true;
    }

    public function updateStatus(Checkout $order, string $status): Checkout
    {
        $legacyStatus = $status;
        if ($status === 'paid') {
            $legacyStatus = 'success';
        } elseif ($status === 'failed') {
            $legacyStatus = 'cancel';
        }

        $order->update([
            'payment_status' => $status,
            'status'         => $legacyStatus
        ]);
        
        Log::info("Payment status updated for {$order->order_id} to {$status} via SimulatorGateway");
        
        return $order;
    }
}
