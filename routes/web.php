<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;

// ─── Route Autentikasi ──────────────────────────────────────────────────────
// throttle:5,1 → maks 5 percobaan login per 1 menit per IP (anti brute-force)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.attempt');

// ─── Route Kontak ─────────────────────────────────────────────────────────────
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');

// ─── Halaman Publik ───────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/koleksi', function () {
    return view('koleksi');
})->name('koleksi');

Route::get('/koleksi/{brand}', function ($brand) {
    // Validasi agar hanya meload file yang ada di folder brand_page
    if (view()->exists('brand_page.' . $brand)) {
        return view('brand_page.' . $brand);
    }
    abort(404);
})->name('brand.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// ─── Route Checkout ───────────────────────────────────────────────────────────
Route::get('/checkout/history', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.history');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/notification', [CheckoutController::class, 'notification'])->name('checkout.notification');

// ─── Route Admin ──────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
});