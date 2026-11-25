@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul ?? 'Data Kategori' }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mb-3">
                            {{-- Perbaikan: Menggunakan rute yang benar sesuai resource route --}}
                            <a href="{{ route('kategori-konser.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </a>
                        </div>

                        @if ($index->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada data kategori. Silakan tambah kategori baru!
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($index as $k)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $k->nama_kategori }}</td>
                                                <td class="text-nowrap">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('kategori-konser.edit', $k->id) }}"
                                                        class="btn btn-warning btn-sm me-1">
                                                        Edit
                                                    </a>
                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('kategori-konser.destroy', $k->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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

{{-- Tambahkan script Bootstrap JS jika belum ada di app.blade.php --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
