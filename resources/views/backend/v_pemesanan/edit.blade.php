@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- Form untuk update data pemesanan --}}
                    {{-- Menggunakan route('pemesanan.update') dengan ID pemesanan --}}
                    {{-- Method PUT/PATCH diperlukan untuk update sesuai RESTful --}}
                    <form class="form-horizontal" action="{{ route('pemesanan.update', $pemesanan->id) }}" method="post">
                        @csrf {{-- Token CSRF untuk keamanan form --}}
                        @method('PUT') {{-- Menggunakan metode PUT untuk update --}}
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul ?? 'Edit Pemesanan' }}</h4>

                            {{-- Meng-include bagian form umum --}}
                            {{-- Variabel $pemesanan akan tersedia di form.blade.php untuk mengisi nilai lama --}}
                            @include('backend.v_pemesanan.form')

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
