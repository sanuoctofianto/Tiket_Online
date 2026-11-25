@extends('backend.v_layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $judul }}</h3>
            <div class="card-tools">
                <a href="{{ route('konser.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Poster</th>
                        <th>Nama Konser</th>
                        <th>Artis</th>
                        <th>Kategori</th>
                        <th>Waktu</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($konser as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/poster-konser/' . $row->poster) }}" alt="Poster"
                                    width="100">
                            </td>
                            <td>{{ $row->nama_konser }}</td>
                            <td>{{ $row->artis }}</td>
                            <td>{{ $row->kategori->nama_kategori }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->waktu)->format('d M Y, H:i') }}</td>
                            <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                            <td>{{ $row->stok_tiket }}</td>
                            <td>
                                <a href="{{ route('konser.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('konser.destroy', $row->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
