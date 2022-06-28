@extends('layouts.admin')

@section('title', 'Ruangan')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Ruangan</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Ruangan </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Ruangan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ruangan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Nama Ruangan</label>
                                        <input class="form-control @error('nama_ruangan') is-invalid @enderror " type="text"
                                            name="nama_ruangan" value="{{ old('nama_ruangan') }}"
                                            placeholder="Nama Ruangan">
                                        @error('nama_ruangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Penggung Jawab Ruangan</label>
                                        <select class="col-12 @error('pegawai_id') is-invalid @enderror " id="select2"
                                            name="pegawai_id">
                                            <option></option>
                                            @foreach ($pegawai as $p)
                                                <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                            @endforeach
                                        </select>
                                        @error('pegawai_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba/assets/css/vendors/select2.css') }}">
@endpush

@push('tambahScript')
    <script src="{{ asset('cuba/assets/js/select2/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#select2").select2({
                placeholder: "Pilih Pegawai",
            });
        });
    </script>
@endpush
