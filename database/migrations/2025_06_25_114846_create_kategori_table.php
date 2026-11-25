<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Pastikan nama tabel adalah 'kategori' (singular)
        Schema::create('kategori', function (Blueprint $table) {
            $table->id(); // Ini akan membuat kolom 'id' sebagai primary key (BIGINT UNSIGNED AUTO_INCREMENT)
            $table->string('nama_kategori')->unique(); // Contoh: kolom untuk nama kategori, pastikan unik
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori'); // Pastikan ini menghapus tabel 'kategori'
    }
};
