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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id(); // Auto Increment[cite: 2]
            $table->string('name', 100); // Nama pengirim[cite: 2]
            $table->string('email', 100); // Email pengirim[cite: 2]
            $table->string('subject', 200); // Subjek pesan[cite: 2]
            $table->text('message'); // Isi pesan[cite: 2]
            $table->string('ip_address', 45)->nullable(); // IP Address pengirim[cite: 2]
            $table->enum('status', ['unread', 'read', 'replied'])->default('unread'); // Status pesan[cite: 2]
            $table->timestamp('created_at')->useCurrent(); // Waktu dikirim[cite: 2]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
