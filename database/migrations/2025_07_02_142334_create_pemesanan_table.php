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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap pemesanan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID user yang melakukan pemesanan
            $table->foreignId('konser_id')->constrained('konser')->onDelete('cascade'); // ID konser yang dipesan
            $table->integer('jumlah_tiket'); // Jumlah tiket yang dipesan
            $table->decimal('total_harga', 10, 2); // Total harga pemesanan
            $table->string('kode_pemesanan')->unique(); // Kode unik untuk pemesanan (misal: INV-20230702-001)
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed', 'refunded'])->default('pending'); // Status pembayaran
            $table->enum('status_pemesanan', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // Status pemesanan
            $table->timestamp('tanggal_pemesanan')->useCurrent(); // Tanggal dan waktu pemesanan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
