<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandAdminController;

// ─── Admin Auth (pintu masuk terpisah) ────────────────────────────────────────
Route::prefix('arven-panel')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
Route::view('/', 'index')->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/koleksi', [BrandController::class, 'index'])->name('koleksi');
Route::view('/contact', 'contact')->name('contact');
Route::view('/cart', 'cart')->name('cart');

Route::get('/koleksi/{brand}', [BrandController::class, 'show'])->name('brand.show');

// ─── Route Autentikasi ────────────────────────────────────────────────────────
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.attempt');
    Route::post('/logout', 'logout')->name('logout');
    
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->middleware('throttle:5,1')->name('register.attempt');
});

// ─── Route Lupa Password ──────────────────────────────────────────────────────
use App\Http\Controllers\Auth\ForgotPasswordController;
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

// ─── Route User Profile ───────────────────────────────────────────────────────
use App\Http\Controllers\ProfileController;
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::put('/profile', 'update')->name('profile.update');
});

// ─── Route Kontak ─────────────────────────────────────────────────────────────
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');

// ─── Route Checkout ───────────────────────────────────────────────────────────
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout/history', 'index')->middleware('auth')->name('checkout.history');
    Route::post('/checkout/process', 'process')->name('checkout.process');
    Route::post('/checkout/notification', 'notification')->name('checkout.notification');
    
    // ─── Payment Simulator ───
    Route::post('/payment/{order}/process', 'simulatePaymentProcess')->name('payment.process');
    Route::post('/payment/{order}/status', 'updatePaymentStatus')->name('payment.status');
});

// ─── Route Admin Panel ────────────────────────────────────────────────────────
Route::middleware(['admin'])->prefix('arven-panel')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Pesanan
    Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::patch('/{id}/status', 'updateStatus')->name('updateStatus');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Pelanggan
    Route::controller(CustomerController::class)->prefix('customers')->name('customers.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::patch('/{id}/toggle', 'toggleActive')->name('toggleActive');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Pesan Kontak
    Route::controller(MessageController::class)->prefix('messages')->name('messages.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::patch('/{id}/read', 'markRead')->name('markRead');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Produk
    Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{product}/edit', 'edit')->name('edit');
        Route::put('/{product}', 'update')->name('update');
        Route::delete('/{product}', 'destroy')->name('destroy');
    });

    // Brand
    Route::controller(BrandAdminController::class)->prefix('brands')->name('brands.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{brand}/edit', 'edit')->name('edit');
        Route::put('/{brand}', 'update')->name('update');
        Route::delete('/{brand}', 'destroy')->name('destroy');
    });
});