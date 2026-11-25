<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\User; // Import model User
use App\Models\Konser; // Import model Konser
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk generate kode unik
use Carbon\Carbon; // Untuk tanggal dan waktu

class PemesananController extends Controller
{
    /**
     * Menampilkan daftar semua pemesanan.
     */
    public function index()
    {
        $pemesanan = Pemesanan::with(['user', 'konser'])->orderBy('tanggal_pemesanan', 'desc')->get();

        return view('backend.v_pemesanan.index', [
            'judul' => 'Data Pemesanan',
            'pemesanan' => $pemesanan,
        ]);
    }

    /**
     * Menampilkan form untuk membuat pemesanan baru.
     */
    public function create()
    {
        // Mengirim daftar user dan konser ke view agar bisa dipilih di form
        $users = User::all();
        $konserList = Konser::all(); // Menggunakan nama variabel berbeda agar tidak bentrok dengan $konser di show/print

        return view('backend.v_pemesanan.create', [
            'judul' => 'Tambah Pemesanan',
            'users' => $users,
            'konserList' => $konserList,
        ]);
    }

    /**
     * Menyimpan data pemesanan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'konser_id' => 'required|exists:konser,id',
            'jumlah_tiket' => 'required|integer|min:1',
            // 'total_harga' tidak divalidasi karena akan dihitung otomatis
            // 'kode_pemesanan' tidak divalidasi karena akan digenerate otomatis
            // 'tanggal_pemesanan' tidak divalidasi karena akan diisi otomatis
            'status_pembayaran' => 'required|in:pending,paid,failed,refunded',
            'status_pemesanan' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        // Ambil data konser untuk menghitung total harga
        $konser = Konser::findOrFail($validatedData['konser_id']);

        // Hitung total harga
        $totalHarga = $konser->harga * $validatedData['jumlah_tiket'];

        // Generate kode pemesanan unik
        $kodePemesanan = 'INV-' . Carbon::now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        while (Pemesanan::where('kode_pemesanan', $kodePemesanan)->exists()) {
            $kodePemesanan = 'INV-' . Carbon::now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        }

        // Siapkan data untuk disimpan
        $pemesananData = array_merge($validatedData, [
            'total_harga' => $totalHarga,
            'kode_pemesanan' => $kodePemesanan,
            'tanggal_pemesanan' => Carbon::now(), // Menggunakan tanggal dan waktu saat ini
        ]);

        // Buat record pemesanan baru
        Pemesanan::create($pemesananData); // Tidak perlu menyimpan ke variabel $pemesanan jika tidak redirect ke print

        // Redirect ke halaman index pemesanan setelah berhasil disimpan
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    /**
     * Menampilkan detail pemesanan tertentu.
     */
    public function show(string $id)
    {
        $pemesanan = Pemesanan::with(['user', 'konser'])->findOrFail($id);

        return view('backend.v_pemesanan.show', [
            'judul' => 'Detail Pemesanan',
            'pemesanan' => $pemesanan,
        ]);
    }

    /**
     * Menampilkan form untuk mengedit data pemesanan.
     */
    public function edit(string $id)
    {
        $pemesanan = Pemesanan::with(['user', 'konser'])->findOrFail($id);
        $users = User::all();
        $konserList = Konser::all();

        return view('backend.v_pemesanan.edit', [
            'judul' => 'Edit Pemesanan',
            'pemesanan' => $pemesanan,
            'users' => $users,
            'konserList' => $konserList,
        ]);
    }

    /**
     * Memperbarui data pemesanan di database.
     */
    public function update(Request $request, string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'konser_id' => 'required|exists:konser,id',
            'jumlah_tiket' => 'required|integer|min:1',
            'status_pembayaran' => 'required|in:pending,paid,failed,refunded',
            'status_pemesanan' => 'required|in:pending,confirmed,cancelled,completed',
            // 'kode_pemesanan' dan 'tanggal_pemesanan' biasanya tidak diupdate manual
        ]);

        // Ambil data konser untuk menghitung total harga baru jika jumlah tiket atau konser berubah
        $konser = Konser::findOrFail($validatedData['konser_id']);
        $totalHarga = $konser->harga * $validatedData['jumlah_tiket'];

        $pemesananData = array_merge($validatedData, [
            'total_harga' => $totalHarga,
        ]);

        $pemesanan->update($pemesananData);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Menghapus data pemesanan dari database.
     */
    public function destroy(string $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }

    /**
     * Menampilkan tampilan untuk mencetak detail pemesanan.
     */
    public function print(string $id)
    {
        $pemesanan = Pemesanan::with(['user', 'konser'])->findOrFail($id);

        return view('backend.v_pemesanan.print', [
            'pemesanan' => $pemesanan,
        ]);
    }
}
