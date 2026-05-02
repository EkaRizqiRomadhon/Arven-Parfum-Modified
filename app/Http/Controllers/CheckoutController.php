<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Menampilkan riwayat belanja pengguna (API).
     */
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Silakan login untuk melihat riwayat'], 401);
        }

        $checkouts = Checkout::with('items')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($checkouts);
    }

    /**
     * Memproses checkout SIMULASI dan menyimpan ke database.
     * Tidak memerlukan API Key Midtrans.
     */
    public function process(Request $request)
    {
        Log::info('Simulated Checkout Started', ['request' => $request->all()]);

        // 1. Persiapkan Data Keranjang
        $cart = $request->input('cart');
        if (!$cart || count($cart) == 0) {
            Log::warning('Checkout Failed: Cart is empty');
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        $grossAmount = 0;
        foreach ($cart as $item) {
            $qty = $item['qty'] ?? ($item['quantity'] ?? 0);
            $grossAmount += ($item['price'] * $qty);
        }

        // 2. Setup Order ID
        $orderId = 'INV-' . strtoupper(Str::random(10));
        
        DB::beginTransaction();
        try {
            Log::info('Saving Simulated Checkout to DB', ['order_id' => $orderId]);
            
            // 3. Simpan ke database (Riwayat Belanja)
            $checkout = Checkout::create([
                'user_id'      => auth()->check() ? auth()->id() : null,
                'order_id'     => $orderId,
                'gross_amount' => $grossAmount,
                'status'       => 'success', // Langsung success karena simulasi
                'snap_token'   => 'SIMULATION-' . Str::random(20),
                'payment_type' => 'simulation',
            ]);

            foreach ($cart as $item) {
                $qty = $item['qty'] ?? ($item['quantity'] ?? 0);
                CheckoutItem::create([
                    'checkout_id' => $checkout->id,
                    'product_id'  => $item['id'],
                    'name'        => $item['name'],
                    'price'       => $item['price'],
                    'quantity'    => $qty,
                    'subtotal'    => $item['price'] * $qty,
                ]);
            }

            DB::commit();
            Log::info('Simulated Checkout Successfully Saved', ['order_id' => $orderId]);

            return response()->json([
                'success'   => true,
                'message'   => 'Pesanan berhasil disimpan (Simulasi)',
                'orderId'   => $orderId,
                'snapToken' => $checkout->snap_token // Tetap kembalikan token simulasi agar frontend tidak error
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Simulated Checkout Error', ['message' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Notification handler (Tidak digunakan dalam mode simulasi, tapi dibiarkan ada)
     */
    public function notification(Request $request)
    {
        return response()->json(['status' => 'simulation_mode_active']);
    }
}
