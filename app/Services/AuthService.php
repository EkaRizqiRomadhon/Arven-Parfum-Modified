<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;

class AuthService
{
    /**
     * Catat aktivitas user ke tabel activity_logs.
     *
     * @param  int    $userId
     * @param  string $action       Contoh: 'login', 'logout', 'password_reset'
     * @param  string $description  Deskripsi aktivitas
     * @param  string $ipAddress    IP address user
     * @return void
     */
    public function logActivity(int $userId, string $action, string $description, string $ipAddress): void
    {
        try {
            ActivityLog::create([
                'user_id'     => $userId,
                'action'      => $action,
                'description' => $description,
                'ip_address'  => $ipAddress,
                'created_at'  => now(),
            ]);
        } catch (\Exception $e) {
            // Activity logging tidak boleh menghentikan proses autentikasi utama
            Log::error('AuthService: Gagal mencatat activity log.', [
                'error'   => $e->getMessage(),
                'user_id' => $userId,
                'action'  => $action,
            ]);
        }
    }
}
