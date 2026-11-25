@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul ?? 'Data User' }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
                        </div>

                        @if ($index->isEmpty())
                            {{-- PERBAIKAN: Menggunakan $index --}}
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada data user. Silakan tambah user baru!
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle" id="myTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>HP</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($index as $user)
                                            {{-- PERBAIKAN: Menggunakan $index --}}
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($user->foto)
                                                        {{-- PERBAIKAN: Menggunakan $user->foto --}}
                                                        <img src="{{ asset('storage/img-user/' . $user->foto) }}"
                                                            alt="Foto Profil" class="img-thumbnail"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                    @else
                                                        <img src="https://placehold.co/50x50/cccccc/ffffff?text=No+Photo"
                                                            alt="No Photo" class="img-thumbnail"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->hp ?? '-' }}</td>
                                                <td>{{ $user->role == '1' ? 'Admin' : 'User Biasa' }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $user->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $user->status == '1' ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                        class="btn btn-info btn-sm me-1">
                                                        Detail
                                                    </a>
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-warning btn-sm me-1">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        style="display:inline-block;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection

{{-- Push scripts for DataTables initialization --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
