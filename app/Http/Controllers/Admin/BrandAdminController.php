<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandAdminController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->orderBy('sort_order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug'        => 'required|string|max:50|unique:brands,slug|alpha_dash',
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string|max:500',
            'sort_order'  => 'required|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $filename = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('brand'), $filename);
            $data['logo'] = 'brand/' . $filename;
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil ditambahkan.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string|max:500',
            'sort_order'  => 'required|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $filename = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move(public_path('brand'), $filename);
            $data['logo'] = 'brand/' . $filename;
        } else {
            unset($data['logo']); // Jaga logo lama
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products()->exists()) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Brand tidak bisa dihapus karena masih memiliki produk.');
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil dihapus.');
    }
}
