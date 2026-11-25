<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Konser; // Pastikan ini ada

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk User
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopian4ji@gmail.com',
            'role' => '2',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);

        // Panggil seeder untuk Kategori
        Kategori::create(['nama_kategori' => 'Pop']);
        Kategori::create(['nama_kategori' => 'Rock']);
        Kategori::create(['nama_kategori' => 'Jazz']);
        Kategori::create(['nama_kategori' => 'Dangdut']);
        Kategori::create(['nama_kategori' => 'Klasik']);

        // Panggil seeder untuk Pemesanan (setelah User dan Konser, karena Pemesanan butuh keduanya)
        // Catatan: Jika KonserSeeder tidak dipanggil, pastikan ada data konser di tabel 'konser'
        // agar PemesananSeeder tidak gagal karena tidak menemukan konser.
        $this->call(PemesananSeeder::class);
    }
}
