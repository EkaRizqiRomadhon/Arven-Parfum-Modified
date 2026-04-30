<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Setup Midtrans Configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 2. Persiapkan Data Keranjang
        $cart = $request->input('cart');
        if (!$cart || count($cart) == 0) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        $grossAmount = 0;
        $itemDetails = [];

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['qty'];
            $grossAmount += $subtotal;
            $itemDetails[] = [
                'id'       => $item['id'],
                'price'    => $item['price'],
                'quantity' => $item['qty'],
                'name'     => substr($item['name'], 0, 50), // Midtrans batas 50 karakter
            ];
        }

        // 3. Setup Order ID & Parameter Transaksi
        $orderId = 'INV-' . strtoupper(Str::random(10));
        
        $transactionDetails = [
            'order_id'     => $orderId,
            'gross_amount' => $grossAmount,
        ];

        // Opsional: Customer Details (Bisa didapat dari Auth jika login)
        $customerDetails = [
            'first_name' => auth()->check() ? auth()->user()->full_name : 'Pelanggan',
            'email'      => auth()->check() ? auth()->user()->email : 'pelanggan@example.com',
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details'        => $itemDetails,
            'customer_details'    => $customerDetails,
        ];

        try {
            // 4. Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            return response()->json([
                'snapToken' => $snapToken,
                'orderId'   => $orderId
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
