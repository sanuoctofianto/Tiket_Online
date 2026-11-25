@extends('backend.v_layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('pemesanan.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul ?? 'Tambah Pemesanan Baru' }}</h4>
                            @include('backend.v_pemesanan.form')
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
