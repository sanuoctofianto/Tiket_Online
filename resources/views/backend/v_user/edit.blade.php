@extends('backend.v_layouts.app')

@section('content')
    <!-- contentAwal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('user.update', $edit->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf {{-- Token CSRF untuk keamanan form --}}
                        @method('PUT') {{-- Metode PUT untuk update --}}
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul ?? 'Ubah User' }}</h4>

                            @include('backend.v_user.form')

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contentAkhir -->
@endsection
