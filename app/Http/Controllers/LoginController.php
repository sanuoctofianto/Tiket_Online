<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     * Method ini diganti dari 'loginBackend' menjadi 'index' agar sesuai dengan route.
     */
    public function index()
    {
        return view('backend.v_login.login', [ // Pastikan path view ini benar
            'judul' => 'Login Admin',
        ]);
    }

    /**
     * Menangani proses otentikasi.
     * Method ini diganti dari 'authenticateBackend' menjadi 'authenticate'.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Catatan: Jika Anda menggunakan kolom 'status' atau 'role' untuk memvalidasi user,
            // pastikan kolom tersebut ada di tabel 'users' Anda.
            // Contoh dari kode Anda:
            // if (Auth::user()->status == 0) {
            //     Auth::logout();
            //     return back()->with('error', 'User belum aktif, silakan hubungi admin.');
            // }

            $request->session()->regenerate();
            // Arahkan ke route dengan nama 'beranda' setelah login berhasil
            return redirect()->intended(route('beranda'));
        }

        // Jika otentikasi gagal
        return back()->with('error', 'Login Gagal! Email atau Password salah.');
    }

    /**
     * Menangani proses logout.
     * Method ini diganti dari 'logoutBackend' menjadi 'logout'.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('login');
    }
}
