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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            // Relasi user (pelapor)
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            // Relasi kategori
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete();
            // Data utama
            $table->string('name');
            $table->date('date');
            $table->string('location');
            $table->text('description');
            // Bukti gambar
            $table->string('image')->nullable();
            $table->string('admin_image')->nullable();
            // Status pengaduan
            $table->enum('status', [
                'menunggu',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('menunggu');
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
