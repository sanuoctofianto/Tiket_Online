@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $judul ?? 'Detail Pemesanan' }}</h4>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Kode Pemesanan:</strong> {{ $pemesanan->kode_pemesanan }}</p>
                                <p><strong>Tanggal Pemesanan:</strong>
                                    {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y H:i') }}</p>
                                <p><strong>User Pemesan:</strong> {{ $pemesanan->user->nama ?? 'N/A' }}
                                    ({{ $pemesanan->user->email ?? 'N/A' }})</p>
                                <p><strong>Konser:</strong> {{ $pemesanan->konser->nama_konser ?? 'N/A' }}</p>
                                <p><strong>Artis:</strong> {{ $pemesanan->konser->artis ?? 'N/A' }}</p>
                                <p><strong>Lokasi Konser:</strong> {{ $pemesanan->konser->lokasi ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Jumlah Tiket:</strong> {{ $pemesanan->jumlah_tiket }}</p>
                                <p><strong>Harga Per Tiket:</strong> Rp
                                    {{ number_format($pemesanan->konser->harga ?? 0, 2, ',', '.') }}</p>
                                <p><strong>Total Harga:</strong> Rp
                                    {{ number_format($pemesanan->total_harga, 2, ',', '.') }}</p>
                                <p><strong>Status Pembayaran:</strong>
                                    <span
                                        class="badge {{ $pemesanan->status_pembayaran == 'paid'
                                            ? 'bg-success'
                                            : ($pemesanan->status_pembayaran == 'pending'
                                                ? 'bg-warning'
                                                : ($pemesanan->status_pembayaran == 'failed'
                                                    ? 'bg-danger'
                                                    : 'bg-secondary')) }}">
                                        {{ ucfirst($pemesanan->status_pembayaran) }}
                                    </span>
                                </p>
                                <p><strong>Status Pemesanan:</strong>
                                    <span
                                        class="badge {{ $pemesanan->status_pemesanan == 'confirmed'
                                            ? 'bg-info'
                                            : ($pemesanan->status_pemesanan == 'pending'
                                                ? 'bg-secondary'
                                                : ($pemesanan->status_pemesanan == 'cancelled'
                                                    ? 'bg-danger'
                                                    : 'bg-primary')) }}">
                                        {{ ucfirst($pemesanan->status_pemesanan) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali ke Daftar
                                Pemesanan</a>
                            <a href="{{ route('pemesanan.print', $pemesanan->id) }}" target="_blank"
                                class="btn btn-info">Cetak Tiket / Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
