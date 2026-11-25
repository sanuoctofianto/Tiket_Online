<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Helpers\ImageHelper; // Pastikan helper ini ada dan berfungsi
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'role' => 'required|in:0,1',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);

        $validatedData['status'] = 0;

        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

        if (!preg_match($pattern, $password)) {
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'])->withInput();
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            // PERBAIKAN: Hanya kirim sub-direktori 'img-user/'
            $directory = 'img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        } else {
            $validatedData['foto'] = null;
        }

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'Data user berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.show', [
            'judul' => 'Detail User',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'hp' => 'required|min:10|max:13',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:users';
        } else {
            $rules['email'] = 'required|max:255|email';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'min:4|confirmed';
            $password = $request->input('password');
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
            if (!preg_match($pattern, $password)) {
                return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'])->withInput();
            }
        }

        $validatedData = $request->validate($rules, [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        if ($request->file('foto')) {
            // Hapus gambar lama jika ada
            // PERBAIKAN: Gunakan public_path() untuk jalur lengkap saat unlink
            if ($user->foto && file_exists(public_path('storage/img-user/' . $user->foto))) {
                unlink(public_path('storage/img-user/' . $user->foto));
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            // PERBAIKAN: Hanya kirim sub-direktori 'img-user/'
            $directory = 'img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        } else {
            unset($validatedData['foto']);
        }

        $user->update($validatedData);
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        // Hapus foto dari storage jika ada
        // PERBAIKAN: Gunakan public_path() untuk jalur lengkap saat unlink
        if ($user->foto && file_exists(public_path('storage/img-user/' . $user->foto))) {
            unlink(public_path('storage/img-user/' . $user->foto));
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus!');
    }

    public function formUser()
    {
        return view('backend.v_user.form', [
            'judul' => 'Laporan Data User',
        ]);
    }

    public function cetakUser(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $query = User::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->orderBy('id', 'desc');
        $user = $query->get();
        return view('backend.v_user.cetak', [
            'judul' => 'Laporan User',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $user
        ]);
    }
}
