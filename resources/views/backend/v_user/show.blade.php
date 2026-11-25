@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul ?? 'Detail User' }}</h4>

                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                {{-- Perbaikan: Menggunakan $user->foto dan jalur asset yang benar --}}
                                @if ($user->foto)
                                    <img src="{{ asset('storage/img-user/' . $user->foto) }}" alt="Foto Profil"
                                        class="img-thumbnail mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <img src="https://placehold.co/150x150/cccccc/ffffff?text=No+Photo" alt="No Photo"
                                        class="img-thumbnail mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                                @endif
                                <h5>{{ $user->nama }}</h5>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-8">
                                <dl class="row">
                                    <dt class="col-sm-4">Nama Lengkap:</dt>
                                    <dd class="col-sm-8">{{ $user->nama }}</dd>

                                    <dt class="col-sm-4">Email:</dt>
                                    <dd class="col-sm-8">{{ $user->email }}</dd>

                                    <dt class="col-sm-4">Nomor HP:</dt>
                                    <dd class="col-sm-8">{{ $user->hp ?? '-' }}</dd>

                                    <dt class="col-sm-4">Hak Akses:</dt>
                                    <dd class="col-sm-8">{{ $user->role == '1' ? 'Admin' : 'User Biasa' }}</dd>

                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge {{ $user->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->status == '1' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Terdaftar Sejak:</dt>
                                    <dd class="col-sm-8">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali ke Daftar User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
