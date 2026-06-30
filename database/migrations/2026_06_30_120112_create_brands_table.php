<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();        // ysl, dior, chanel, dll
            $table->string('name');                  // Yves Saint Laurent
            $table->string('logo');                  // brand/ysl.png
            $table->string('description')->nullable();
            $table->integer('sort_order')->default(0); // urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
