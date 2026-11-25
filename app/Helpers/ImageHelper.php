<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
// use Intervention\Image\Facades\Image; // Hapus baris ini karena kita akan menggunakan ImageManager langsung
use Intervention\Image\ImageManager; // Tambahkan ini
use Intervention\Image\Drivers\Gd\Driver; // Tambahkan ini untuk menggunakan driver GD

class ImageHelper
{
    /**
     * Upload dan resize gambar.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $subDirectory Sub-direktori di dalam public/storage/ (misal: 'img-user/')
     * @param string $fileName Nama file yang akan disimpan
     * @param int $width Lebar gambar yang diinginkan
     * @param int|null $height Tinggi gambar yang diinginkan (null untuk otomatis)
     * @return bool
     */
    public static function uploadAndResize($file, $subDirectory, $fileName, $width, $height = null)
    {
        // Jalur lengkap ke direktori tempat gambar akan disimpan
        $fullDirectoryPath = public_path('storage/' . $subDirectory);

        // Pastikan direktori ada
        if (!File::isDirectory($fullDirectoryPath)) {
            File::makeDirectory($fullDirectoryPath, 0755, true, true);
        }

        // PERUBAHAN UTAMA: Buat instance ImageManager dengan driver GD
        $manager = new ImageManager(new Driver());

        // Buat instance Intervention Image dari file yang diupload
        // Menggunakan read() untuk Intervention Image v3+
        $img = $manager->read($file);

        // Resize gambar
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Simpan gambar ke jalur lengkap
        return $img->save($fullDirectoryPath . $fileName);
    }
}
