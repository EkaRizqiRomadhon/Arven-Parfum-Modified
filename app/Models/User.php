<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     * Sesuai dengan struktur tabel users di arven-parfume.sql.
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'is_active',
        'email_verified',
        'last_login',
    ];

    /**
     * Kolom yang harus disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login' => 'datetime',
        'is_active' => 'boolean',
        'email_verified' => 'boolean',
    ];

    /**
     * Relasi ke Checkout (Satu user memiliki banyak riwayat belanja).
     */
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    /**
     * Relasi ke ActivityLog (Satu user memiliki banyak log).
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
