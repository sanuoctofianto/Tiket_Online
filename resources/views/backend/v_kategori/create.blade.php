@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- Perbaikan: Menggunakan rute yang benar sesuai resource route --}}
                    <form class="form-horizontal" action="{{ route('kategori-konser.store') }}" method="post">
                        @csrf {{-- Token CSRF untuk keamanan form --}}
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul ?? 'Tambah Kategori' }}</h4>

                            <div class="form-group row">
                                <label for="nama_kategori" class="col-sm-3 text-end control-label col-form-label">Nama
                                    Kategori</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                                        class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                        placeholder="Masukkan Nama Kategori" required autofocus>
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                {{-- Perbaikan: Menggunakan rute yang benar untuk kembali ke index kategori --}}
                                <a href="{{ route('kategori-konser.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
