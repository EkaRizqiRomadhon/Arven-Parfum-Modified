<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::where('role', 'user')->with('checkouts')->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    public function toggleActive($id)
    {
        $customer = User::where('role', 'user')->findOrFail($id);
        $customer->update(['is_active' => !$customer->is_active]);

        $status = $customer->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.customers.show', $id)
            ->with('success', "Pelanggan berhasil {$status}.");
    }

    public function destroy($id)
    {
        User::where('role', 'user')->findOrFail($id)->delete();
        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
