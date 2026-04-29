<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id(); // Auto Increment
            $table->unsignedBigInteger('user_id')->nullable(); // Sesuai tipe data id users[cite: 2]
            $table->string('action', 50); // Sesuai panjang varchar di SQL[cite: 2]
            $table->text('description')->nullable(); // Deskripsi log[cite: 2]
            $table->string('ip_address', 45)->nullable(); // IP Address[cite: 2]
            $table->timestamp('created_at')->useCurrent(); // Waktu log dibuat[cite: 2]

            // Opsional: Aktifkan jika ingin hubungan relasi antar tabel
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
