<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /**
     * Nama tabel di database.
     */
    protected $table = 'contact_messages';

    /**
     * Hanya created_at yang ada, tidak ada updated_at.
     * Matikan auto-management timestamps bawaan Laravel.
     */
    public $timestamps = false;

    /**
     * Kolom yang BOLEH diisi secara massal (Mass Assignment Protection).
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'status',
        'created_at',
    ];

    /**
     * Casting tipe data otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Cek apakah pesan ini belum dibaca.
     */
    public function isUnread(): bool
    {
        return $this->status === 'unread';
    }

    /**
     * Scope untuk filter pesan yang belum dibaca (untuk admin panel).
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}

