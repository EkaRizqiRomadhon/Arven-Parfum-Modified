<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Checkout::with(['user', 'items'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(\App\Http\Requests\Admin\UpdateOrderStatusRequest $request, $id)
    {
        $order = Checkout::findOrFail($id);
        $order->update(['status' => $request->validated()['status']]);

        return redirect()->route('admin.orders.show', $id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Checkout::findOrFail($id)->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
