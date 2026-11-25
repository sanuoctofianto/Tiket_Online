<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_kategori.index', [
            'judul' => 'Kategori',
            'index' => $kategori
        ]);
    }

    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'Kategori',
        ]);
    }

    /**
     * Menyimpan sumber daya yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori',
        ]);
        Kategori::create($validatedData);
        // Perbaikan: Menggunakan nama rute yang benar sesuai resource route
        return redirect()->route('kategori-konser.index')->with('success', 'Data berhasil tersimpan');
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan formulir untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::find($id);
        return view('backend.v_kategori.edit', [
            'judul' => 'Kategori',
            'edit' => $kategori
        ]);
    }

    /**
     * Memperbarui sumber daya yang ditentukan di penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori,' . $id,
        ];
        $validatedData = $request->validate($rules);
        Kategori::where('id', $id)->update($validatedData);
        // Perbaikan: Menggunakan nama rute yang benar sesuai resource route
        return redirect()->route('kategori-konser.index')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Menghapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        // Perbaikan: Menggunakan nama rute yang benar sesuai resource route
        return redirect()->route('kategori-konser.index')->with('success', 'Data berhasil dihapus');
    }
}
