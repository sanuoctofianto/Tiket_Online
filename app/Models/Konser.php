<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    use HasFactory;

    protected $table = 'konser'; // Opsional, tapi baik untuk kejelasan jika nama tabel Anda 'konser' (singular)

    protected $fillable = [
        'nama_konser',
        'artis',
        'kategori_id', // Pastikan ini ada dan namanya 'kategori_id'
        'waktu',
        'lokasi',
        'harga',
        'stok_tiket',
        'poster',
        'deskripsi', // Tambahkan ini jika ada di form Anda
    ];

    // Definisi relasi ke Kategori
    public function kategori()
    {
        // Pastikan ini merujuk ke model Kategori dan foreign key-nya sesuai
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
