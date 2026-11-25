@extends('backend.v_layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- UBAH RUTE INI UNTUK KONSERS --}}
                    <form class="form-horizontal" action="{{ route('konser.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Tambah Konser Baru</h4> {{-- Ubah judul --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Poster</label> {{-- Untuk Poster Konser --}}
                                        <img class="img-preview img-fluid mb-3 col-sm-5" style="max-height: 200px;">
                                        <input type="file" name="poster"
                                            class="form-control @error('poster') is-invalid @enderror"
                                            onchange="previewImage()">
                                        @error('poster')
                                            <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama Konser</label> {{-- Untuk Nama Konser --}}
                                        <input type="text" name="nama_konser" value="{{ old('nama_konser') }}"
                                            class="form-control @error('nama_konser') is-invalid @enderror"
                                            placeholder="Masukkan Nama Konser">
                                        @error('nama_konser')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Artis</label> {{-- Untuk Artis Konser --}}
                                        <input type="text" name="artis" value="{{ old('artis') }}"
                                            class="form-control @error('artis') is-invalid @enderror"
                                            placeholder="Masukkan Nama Artis/Band">
                                        @error('artis')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror"
                                            name="kategori_id">
                                            <option value="" selected>--Pilih Kategori--</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Konser</label> {{-- Untuk Waktu Konser (DateTime) --}}
                                        <input type="datetime-local" name="waktu" value="{{ old('waktu') }}"
                                            class="form-control @error('waktu') is-invalid @enderror">
                                        @error('waktu')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label> {{-- Untuk Lokasi Konser --}}
                                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                            class="form-control @error('lokasi') is-invalid @enderror"
                                            placeholder="Masukkan Lokasi Konser">
                                        @error('lokasi')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Tiket</label> {{-- Untuk Harga Tiket --}}
                                        <input type="number" step="0.01" name="harga" value="{{ old('harga') }}"
                                            class="form-control @error('harga') is-invalid @enderror"
                                            placeholder="Masukkan Harga Tiket">
                                        @error('harga')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Stok Tiket</label> {{-- Untuk Stok Tiket --}}
                                        <input type="number" name="stok_tiket" value="{{ old('stok_tiket') }}"
                                            class="form-control @error('stok_tiket') is-invalid @enderror"
                                            placeholder="Masukkan Stok Tiket">
                                        @error('stok_tiket')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label><br> {{-- Untuk Deskripsi Konser --}}
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <span class="invalid-feedback alert-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('konser.index') }}"> {{-- Ubah rute kembali ke index konser --}}
                                    <button type="button" class="btn btn-secondary">Kembali</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Fungsi untuk preview gambar poster
        function previewImage() {
            const image = document.querySelector('input[name="poster"]');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        // Fungsi untuk memastikan input hanya angka (jika diperlukan untuk harga/stok)
        function hanyaAngka(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        // Inisialisasi CKEditor jika Anda menggunakannya (sesuai id="ckeditor" sebelumnya)
        // Jika Anda ingin menggunakan CKEditor, pastikan Anda telah mengintegrasikannya dengan benar.
        // Contoh sederhana:
        // document.addEventListener('DOMContentLoaded', function() {
        //     if (typeof CKEDITOR !== 'undefined') {
        //         CKEDITOR.replace('deskripsi'); // Ganti 'deskripsi' dengan name textarea yang ingin pakai CKEditor
        //     }
        // });
    </script>
@endsection
