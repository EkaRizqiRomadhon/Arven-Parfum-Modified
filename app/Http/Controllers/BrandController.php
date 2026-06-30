<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Tampilkan halaman daftar brand (koleksi).
     * Route: GET /koleksi
     */
    public function index()
    {
        // 100% dari DB — terurut sesuai sort_order
        $brands = Brand::orderBy('sort_order')->get();

        return view('koleksi', compact('brands'));
    }

    /**
     * Tampilkan halaman produk per brand.
     * Route: GET /koleksi/{brand}
     */
    public function show(string $slug)
    {
        // Validasi brand dari DB, bukan hardcoded
        $brand = Brand::where('slug', $slug)->firstOrFail();

        $products = Product::where('brand', $slug)->get();

        return view('brand_page.show', compact('products', 'brand'));
    }
}
