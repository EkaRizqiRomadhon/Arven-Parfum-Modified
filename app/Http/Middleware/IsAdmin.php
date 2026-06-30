<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek guard 'admin' — terpisah dari guard 'web' (user biasa)
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->with('info', 'Silakan login sebagai admin untuk melanjutkan.');
        }

        // Pastikan role-nya memang admin
        if (Auth::guard('admin')->user()->role !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Akses ditolak.']);
        }

        return $next($request);
    }
}
