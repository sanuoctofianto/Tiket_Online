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
        Schema::create('konser', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konser');
            $table->string('artis');
            $table->unsignedBigInteger('kategori_id'); // <-- UBAH INI: dari kategori_konser_id
            $table->dateTime('waktu');
            $table->string('lokasi');
            $table->decimal('harga', 10, 2);
            $table->integer('stok_tiket');
            $table->text('deskripsi')->nullable();
            $table->string('poster')->nullable(); // Path untuk menyimpan gambar poster
            $table->timestamps();

            // Foreign key ke tabel kategori
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade'); // <-- PASTIKAN INI TETAP 'kategori'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konser'); // <-- TAMBAHKAN INI (penting untuk migrate:fresh)
    }
};
