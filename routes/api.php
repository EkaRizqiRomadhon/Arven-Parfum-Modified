<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CheckoutApiController;
use App\Http\Controllers\Api\Admin\OrderApiController;
use App\Http\Controllers\Api\Admin\CustomerApiController;
use App\Http\Controllers\Api\Admin\MessageApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini otomatis mendapat prefix /api dan stateless (tanpa
| session). Gunakan token (Sanctum) untuk autentikasi dari klien mobile
| atau third-party service.
|
*/

// ─── Auth Publik (tidak perlu token) ─────────────────────────────────────────
Route::prefix('auth')->name('api.auth.')->controller(AuthApiController::class)->group(function () {
    Route::post('/login', 'login')->middleware('throttle:5,1')->name('login');
    Route::post('/register', 'register')->middleware('throttle:5,1')->name('register');
});

// ─── Produk / Koleksi Publik (tidak perlu token) ─────────────────────────────
Route::prefix('products')->name('api.products.')->controller(ProductApiController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{brand}', 'show')->name('show');
});

// ─── Route Terproteksi (butuh JWT Bearer Token) ───────────────────────────────
Route::middleware('auth:api')->group(function () {

    // Auth
    Route::prefix('auth')->name('api.auth.')->controller(AuthApiController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::get('/me', 'me')->name('me');
    });

    // Checkout
    Route::prefix('checkout')->name('api.checkout.')->controller(CheckoutApiController::class)->group(function () {
        Route::get('/history', 'history')->name('history');
        Route::post('/process', 'process')->name('process');
    });

    // ── Route Admin API (role: admin) ─────────────────────────────────────────
    Route::middleware('admin')->prefix('admin')->name('api.admin.')->group(function () {

        // Pesanan
        Route::controller(OrderApiController::class)->prefix('orders')->name('orders.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('/{id}/status', 'updateStatus')->name('updateStatus');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Pelanggan
        Route::controller(CustomerApiController::class)->prefix('customers')->name('customers.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('/{id}/toggle', 'toggleActive')->name('toggleActive');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Pesan Kontak
        Route::controller(MessageApiController::class)->prefix('messages')->name('messages.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::patch('/{id}/read', 'markRead')->name('markRead');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });
});
