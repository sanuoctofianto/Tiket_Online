<?php
// app/Http/Controllers/KonserController.php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Kategori; // Pastikan ini mengacu pada model Kategori yang benar
use Illuminate\Http\Request;

class KonserController extends Controller
{
    /**
     * Menampilkan daftar semua konser.
     */
    public function index()
    {
        // Memuat data konser beserta relasi kategori, diurutkan berdasarkan ID terbaru
        $konser = Konser::with('kategori')->orderBy('id', 'desc')->get();
        return view('backend.v_konser.index', [
            'judul' => 'Data Konser',
            'konser' => $konser
        ]);
    }

    /**
     * Menampilkan form untuk membuat konser baru.
     */
    public function create()
    {
        // Mengambil semua data kategori untuk dropdown di form
        $kategori = Kategori::all();
        return view('backend.v_konser.create', [
            'judul' => 'Tambah Konser',
            'kategori' => $kategori
        ]);
    }

    /**
     * Menyimpan data konser baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $request->validate([
            'nama_konser' => 'required|string|max:255', // Validasi nama konser
            'artis' => 'required|string|max:255',       // Validasi nama artis
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id, pastikan ada di tabel 'kategori'
            'waktu' => 'required|date',                 // Validasi format tanggal dan waktu
            'lokasi' => 'required|string|max:255',      // Validasi lokasi
            'harga' => 'required|numeric|min:0',        // Validasi harga (harus angka, minimal 0)
            'stok_tiket' => 'required|integer|min:0',   // Validasi stok tiket (harus integer, minimal 0)
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Poster opsional, harus gambar, maks 2MB
            'deskripsi' => 'nullable|string', // Deskripsi opsional
        ]);

        $data = $request->all();

        // Mengelola upload file poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Pindahkan file ke direktori public/storage/poster-konser
            $file->move(public_path('storage/poster-konser'), $filename);
            $data['poster'] = $filename; // Simpan nama file ke array data
        } else {
            $data['poster'] = null; // Jika tidak ada poster, set null
        }

        // Membuat record konser baru di database
        Konser::create($data);

        // Redirect kembali ke halaman index konser dengan pesan sukses
        return redirect()->route('konser.index')->with('success', 'Data konser berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data konser.
     */
    public function edit(string $id)
    {
        // Mencari konser berdasarkan ID, jika tidak ditemukan akan menampilkan 404
        $konser = Konser::findOrFail($id);
        // Mengambil semua data kategori untuk dropdown di form edit
        $kategori = Kategori::all();
        return view('backend.v_konser.edit', [
            'judul' => 'Edit Konser',
            'konser' => $konser,
            'kategori' => $kategori
        ]);
    }

    /**
     * Memperbarui data konser di database.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk dari form update
        $request->validate([
            'nama_konser' => 'required|string|max:255',
            'artis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id', // Pastikan ini 'kategori_id'
            'waktu' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok_tiket' => 'required|integer|min:0',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Poster opsional saat update
            'deskripsi' => 'nullable|string',
        ]);

        $konser = Konser::findOrFail($id);
        $data = $request->all();

        // Mengelola upload file poster saat update
        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada dan file-nya ada di storage
            if ($konser->poster && file_exists(public_path('storage/poster-konser/' . $konser->poster))) {
                unlink(public_path('storage/poster-konser/' . $konser->poster));
            }

            $file = $request->file('poster');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/poster-konser'), $filename);
            $data['poster'] = $filename;
        } else {
            // Jika tidak ada file baru diupload, pastikan kolom 'poster' tidak diupdate
            // agar nilai poster lama tetap tersimpan.
            unset($data['poster']);
        }

        // Memperbarui record konser di database
        $konser->update($data);

        // Redirect kembali ke halaman index konser dengan pesan sukses
        return redirect()->route('konser.index')->with('success', 'Data konser berhasil diperbarui.');
    }

    /**
     * Menghapus data konser dari database.
     */
    public function destroy(string $id)
    {
        $konser = Konser::findOrFail($id);

        // Hapus poster dari storage jika ada dan file-nya ada
        if ($konser->poster && file_exists(public_path('storage/poster-konser/' . $konser->poster))) {
            unlink(public_path('storage/poster-konser/' . $konser->poster));
        }

        // Menghapus record konser dari database
        $konser->delete();

        // Redirect kembali ke halaman index konser dengan pesan sukses
        return redirect()->route('konser.index')->with('success', 'Data konser berhasil dihapus.');
    }
}
