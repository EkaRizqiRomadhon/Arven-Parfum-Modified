<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('brand')->orderBy('name')->paginate(20)->withQueryString();
        $brands   = Brand::orderBy('sort_order')->get();

        return view('admin.products.index', compact('products', 'brands'));
    }

    public function create()
    {
        $brands = Brand::orderBy('sort_order')->get();
        return view('admin.products.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|exists:brands,slug',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $data['image']);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $brands = Brand::orderBy('sort_order')->get();
        return view('admin.products.edit', compact('product', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|exists:brands,slug',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $data['image']);
        } else {
            unset($data['image']); // Jaga gambar lama
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
