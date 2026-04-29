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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key auto-increment

            // Sesuaikan 'name' menjadi 'full_name' sesuai SQL
            $table->string('full_name', 100);

            $table->string('email', 100)->unique(); // Sesuai panjang varchar di SQL
            $table->string('password');

            // Tambahkan kolom role dan status sesuai SQL
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->boolean('is_active')->default(true);
            $table->boolean('email_verified')->default(false); // Di SQL menggunakan tinyint

            $table->timestamp('last_login')->nullable(); // Sesuai kolom last_login di SQL[cite: 2]
            $table->rememberToken(); // Untuk fitur "remember me" Laravel
            $table->timestamps(); // Menghasilkan created_at dan updated_at[cite: 2]
        });

        // Tabel password_reset_tokens & sessions biarkan saja (standar Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
