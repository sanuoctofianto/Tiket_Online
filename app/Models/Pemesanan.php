<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    // Laravel secara default akan mencari tabel 'pemesanans' (plural dari nama model)
    // Karena tabel Anda bernama 'pemesanan' (singular), kita perlu mendefinisikannya secara eksplisit.
    protected $table = 'pemesanan';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'user_id',
        'konser_id',
        'jumlah_tiket',
        'total_harga',
        'kode_pemesanan',
        'status_pembayaran',
        'status_pemesanan',
        'tanggal_pemesanan',
    ];

    // Kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
    ];

    /**
     * Mendefinisikan relasi Pemesanan ke User.
     * Sebuah pemesanan dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mendefinisikan relasi Pemesanan ke Konser.
     * Sebuah pemesanan terkait dengan satu konser.
     */
    public function konser()
    {
        return $this->belongsTo(Konser::class, 'konser_id');
    }
}
