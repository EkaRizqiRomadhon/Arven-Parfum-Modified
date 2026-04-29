<?php

namespace App\Services;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactService
{
    /**
     * Simpan pesan kontak ke database dan kirim notifikasi email ke admin.
     *
     * @param  array  $data  Data tervalidasi dari StoreContactRequest
     * @param  string $ip    IP address pengirim
     * @return ContactMessage
     */
    public function storeAndNotify(array $data, string $ip): ContactMessage
    {
        // 1. Simpan pesan ke database
        $message = ContactMessage::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'subject'    => $data['subject'],
            'message'    => $data['message'],
            'ip_address' => $ip,
            'status'     => 'unread',
            'created_at' => now(),
        ]);

        // 2. Kirim notifikasi email ke admin (dengan fallback agar tidak crash)
        $this->sendAdminNotification($message);

        return $message;
    }

    /**
     * Kirim email notifikasi ke admin parfum.
     * Jika gagal (misal: konfigurasi mail belum diset), log error saja.
     */
    private function sendAdminNotification(ContactMessage $message): void
    {
        $adminEmail = config('mail.admin_email', config('mail.from.address'));

        if (blank($adminEmail) || $adminEmail === 'hello@example.com') {
            // Jangan kirim jika email admin belum dikonfigurasi
            return;
        }

        try {
            Mail::raw(
                "Pesan baru dari: {$message->name} <{$message->email}>\n\n" .
                "Subjek: {$message->subject}\n\n" .
                "Pesan:\n{$message->message}\n\n" .
                "Dikirim dari IP: {$message->ip_address}",
                function ($mail) use ($message, $adminEmail) {
                    $mail->to($adminEmail)
                         ->subject("[Arven Parfum] Pesan Baru: {$message->subject}")
                         ->replyTo($message->email, $message->name);
                }
            );
        } catch (\Exception $e) {
            // Catat error tapi jangan hentikan proses utama
            Log::error('ContactService: Gagal mengirim notifikasi email admin.', [
                'error'      => $e->getMessage(),
                'message_id' => $message->id,
            ]);
        }
    }
}
