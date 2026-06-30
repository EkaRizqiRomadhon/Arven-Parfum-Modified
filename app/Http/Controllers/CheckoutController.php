<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\PaymentService;

class CheckoutController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Menampilkan halaman riwayat belanja pengguna.
     */
    public function index()
    {
        $orders = Checkout::with('items')
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('history', compact('orders'));
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
                'user_id'        => \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::id() : null,
                'order_id'       => $orderId,
                'gross_amount'   => $grossAmount,
                'status'         => 'pending',
                'payment_status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $qty = $item['qty'] ?? ($item['quantity'] ?? 0);
                
                $product = \App\Models\Product::find($item['id']);
                if (!$product) {
                    throw new \Exception("Produk {$item['name']} tidak ditemukan.");
                }
                
                if ($product->stock < $qty) {
                    throw new \Exception("Stok untuk produk {$item['name']} tidak mencukupi (Sisa: {$product->stock}).");
                }
                
                $product->decrement('stock', $qty);

                CheckoutItem::create([
                    'checkout_id' => $checkout->id,
                    'product_id'  => $item['id'],
                    'name'        => $item['name'],
                    'price'       => $item['price'],
                    'quantity'    => $qty,
                    'subtotal'    => $item['price'] * $qty,
                ]);
            }

            // 4. Inisialisasi Payment via Service
            $snapToken = $this->paymentService->createPayment($checkout);

            DB::commit();
            Log::info('Simulated Checkout Successfully Saved', ['order_id' => $orderId]);

            return response()->json([
                'success'   => true,
                'message'   => 'Pesanan berhasil disimpan.',
                'orderId'   => $orderId,
                'snapToken' => $snapToken 
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Simulated Checkout Error', ['message' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Notification handler
     */
    public function notification(Request $request)
    {
        return response()->json(['status' => 'simulation_mode_active']);
    }

    /**
     * Simulator: Proses pembayaran (ubah ke processing)
     */
    public function simulatePaymentProcess(Request $request, $orderId)
    {
        $order = Checkout::where('order_id', $orderId)->firstOrFail();
        
        $paymentType = $request->input('method', 'simulation');
        $this->paymentService->processPayment($order, $paymentType);
        
        return response()->json([
            'success' => true,
            'status' => 'processing'
        ]);
    }

    /**
     * Simulator: Update status akhir (paid/failed)
     */
    public function updatePaymentStatus(Request $request, $orderId)
    {
        $order = Checkout::where('order_id', $orderId)->firstOrFail();
        
        $status = $request->input('status', 'paid');
        $this->paymentService->updateStatus($order, $status);
        
        return response()->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
