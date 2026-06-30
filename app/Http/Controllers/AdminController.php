<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Pesanan Hari Ini
        $todayOrders = Checkout::whereDate('created_at', today())->count();
        $totalOrders = Checkout::count();

        // 2. Total Pendapatan (Status sukses dari Midtrans biasanya settlement/capture)
        $totalRevenue = Checkout::whereIn('status', ['settlement', 'capture', 'success'])->sum('gross_amount');
        
        // 3. Pelanggan Aktif
        $totalUsers = User::where('role', 'user')->count();
        $newUsersToday = User::where('role', 'user')->whereDate('created_at', today())->count();

        // 4. Pesanan Terbaru
        $recentOrders = Checkout::with('user')->orderBy('created_at', 'desc')->take(7)->get();

        return view('admin.dashboard', compact(
            'todayOrders',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'newUsersToday',
            'recentOrders'
        ));
    }

    public function orders()
    {
        $orders = Checkout::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function customers()
    {
        $customers = User::where('role', 'user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.customers', compact('customers'));
    }
}
