@extends('backend.v_layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $judul }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('konser.update', $konser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_konser" class="form-label">Nama Konser</label>
                            <input type="text" name="nama_konser" value="{{ old('nama_konser', $konser->nama_konser) }}"
                                class="form-control @error('nama_konser') is-invalid @enderror">
                            @error('nama_konser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="artis" class="form-label">Artis</label>
                            <input type="text" name="artis" value="{{ old('artis', $konser->artis) }}"
                                class="form-control @error('artis') is-invalid @enderror">
                            @error('artis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ $konser->kategori_id == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Waktu & Tanggal</label>
                            <input type="datetime-local" name="waktu"
                                value="{{ old('waktu', \Carbon\Carbon::parse($konser->waktu)->format('Y-m-d\TH:i')) }}"
                                class="form-control @error('waktu') is-invalid @enderror">
                            @error('waktu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $konser->lokasi) }}"
                                class="form-control @error('lokasi') is-invalid @enderror">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Tiket</label>
                            <input type="number" name="harga" value="{{ old('harga', $konser->harga) }}"
                                class="form-control @error('harga') is-invalid @enderror">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok_tiket" class="form-label">Stok Tiket</label>
                            <input type="number" name="stok_tiket" value="{{ old('stok_tiket', $konser->stok_tiket) }}"
                                class="form-control @error('stok_tiket') is-invalid @enderror">
                            @error('stok_tiket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster Konser</label>
                            <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <small>Poster Saat Ini:</small><br>
                                <img id="poster-preview" src="{{ asset('storage/poster-konser/' . $konser->poster) }}"
                                    width="150" alt="Poster">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $konser->deskripsi) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('konser.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    {{-- JavaScript preview poster --}}
    <script>
        document.querySelector('input[name="poster"]').addEventListener('change', function(e) {
            const preview = document.querySelector('#poster-preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
