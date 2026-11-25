<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemesanan;
use App\Models\User; // Import model User
use App\Models\Konser; // Import model Konser
use Illuminate\Support\Str; // Untuk generate kode unik
use Carbon\Carbon; // Untuk tanggal dan waktu

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user dan konser di database Anda
        $userAdmin = User::where('email', 'admin@gmail.com')->first();
        $userSopian = User::where('email', 'sopian4ji@gmail.com')->first();
        $konserPop = Konser::where('nama_konser', 'Konser Musik Pop Spektakuler')->first();
        $konserRock = Konser::where('nama_konser', 'Rock Legends Live')->first();

        if ($userAdmin && $userSopian && $konserPop && $konserRock) {
            // Pemesanan oleh Admin
            Pemesanan::create([
                'user_id' => $userAdmin->id,
                'konser_id' => $konserPop->id,
                'jumlah_tiket' => 2,
                'total_harga' => $konserPop->harga * 2,
                'kode_pemesanan' => 'INV-' . Str::upper(Str::random(6)),
                'status_pembayaran' => 'paid',
                'status_pemesanan' => 'confirmed',
                'tanggal_pemesanan' => Carbon::now()->subDays(10),
            ]);

            // Pemesanan oleh Sopian Aji
            Pemesanan::create([
                'user_id' => $userSopian->id,
                'konser_id' => $konserRock->id,
                'jumlah_tiket' => 1,
                'total_harga' => $konserRock->harga * 1,
                'kode_pemesanan' => 'INV-' . Str::upper(Str::random(6)),
                'status_pembayaran' => 'pending',
                'status_pemesanan' => 'pending',
                'tanggal_pemesanan' => Carbon::now()->subDays(5),
            ]);

            Pemesanan::create([
                'user_id' => $userAdmin->id,
                'konser_id' => $konserRock->id,
                'jumlah_tiket' => 3,
                'total_harga' => $konserRock->harga * 3,
                'kode_pemesanan' => 'INV-' . Str::upper(Str::random(6)),
                'status_pembayaran' => 'failed',
                'status_pemesanan' => 'cancelled',
                'tanggal_pemesanan' => Carbon::now()->subDays(2),
            ]);
        } else {
            echo "Pastikan ada user dan konser di database sebelum menjalankan PemesananSeeder.\n";
        }
    }
}
