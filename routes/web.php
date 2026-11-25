<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KonserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\UserController;

// Route default, arahkan ke halaman login backend
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk otentikasi
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Grup route untuk backend yang memerlukan otentikasi
Route::middleware(['auth'])->group(function () {
    // Rute Beranda
    Route::get('beranda', [BerandaController::class, 'berandaBackend'])->name('beranda');

    // Resourceful route untuk mengelola semua aksi CRUD Konser
    Route::resource('konser', KonserController::class);

    // Resourceful route untuk Kategori Konser
    Route::resource('kategori-konser', KategoriController::class);

    // Resourceful route untuk Pemesanan
    Route::resource('pemesanan', PemesananController::class);

    // Rute khusus untuk mencetak detail pemesanan
    Route::get('pemesanan/{pemesanan}/print', [PemesananController::class, 'print'])->name('pemesanan.print');
    // Resourceful route untuk User
    Route::resource('user', UserController::class);
});
