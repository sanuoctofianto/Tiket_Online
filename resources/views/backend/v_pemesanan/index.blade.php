@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul ?? 'Data Pemesanan' }}</h4>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Tombol Tambah Pemesanan (opsional, jika pemesanan bisa dibuat dari admin) --}}
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pemesanan
                            </a>
                        </div>

                        @if ($pemesanan->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Belum ada data pemesanan.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Pemesanan</th>
                                            <th>User</th>
                                            <th>Konser</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Total Harga</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Pemesanan</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemesanan as $pesan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pesan->kode_pemesanan }}</td>
                                                <td>{{ $pesan->user->nama ?? 'User Tidak Ditemukan' }}</td>
                                                {{-- Menampilkan nama user dari relasi --}}
                                                <td>{{ $pesan->konser->nama_konser ?? 'Konser Tidak Ditemukan' }}</td>
                                                {{-- Menampilkan nama konser dari relasi --}}
                                                <td>{{ $pesan->jumlah_tiket }}</td>
                                                <td>Rp {{ number_format($pesan->total_harga, 2, ',', '.') }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $pesan->status_pembayaran == 'paid'
                                                            ? 'bg-success'
                                                            : ($pesan->status_pembayaran == 'pending'
                                                                ? 'bg-warning'
                                                                : ($pesan->status_pembayaran == 'failed'
                                                                    ? 'bg-danger'
                                                                    : 'bg-secondary')) }}">
                                                        {{ ucfirst($pesan->status_pembayaran) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $pesan->status_pemesanan == 'confirmed'
                                                            ? 'bg-info'
                                                            : ($pesan->status_pemesanan == 'pending'
                                                                ? 'bg-secondary'
                                                                : ($pesan->status_pemesanan == 'cancelled'
                                                                    ? 'bg-danger'
                                                                    : 'bg-primary')) }}">
                                                        {{ ucfirst($pesan->status_pemesanan) }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($pesan->tanggal_pemesanan)->format('d M Y H:i') }}
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('pemesanan.show', $pesan->id) }}"
                                                        class="btn btn-info btn-sm me-1">
                                                        Detail
                                                    </a>
                                                    <a href="{{ route('pemesanan.print', $pesan->id) }}" target="_blank"
                                                        class="btn btn-secondary btn-sm me-1">
                                                        Cetak
                                                    </a>
                                                    {{-- Tombol Edit dan Hapus (opsional, jika pemesanan bisa diubah/dihapus dari admin) --}}
                                                    <a href="{{ route('pemesanan.edit', $pesan->id) }}"
                                                        class="btn btn-warning btn-sm me-1">Edit</a>
                                                    <form action="{{ route('pemesanan.destroy', $pesan->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')">Hapus</button>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
