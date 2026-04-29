<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * Nama tabel di database.
     */
    protected $table = 'activity_logs';

    /**
     * Hanya created_at yang ada (tidak ada updated_at).
     * Matikan auto-management timestamps bawaan Laravel.
     */
    public $timestamps = false;

    /**
     * Kolom yang BOLEH diisi secara massal (Mass Assignment Protection).
     * JANGAN tambahkan kolom sensitif seperti 'id' atau 'user_id' dari luar request.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'created_at',
    ];

    /**
     * Kolom yang TIDAK boleh diisi secara massal (double protection).
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * Casting tipe data otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'user_id'    => 'integer',
    ];

    /**
     * Relasi balik ke User (Satu log dimiliki oleh satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

