@extends('layouts.admin')

@section('title', 'Suplier')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Suplier</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Suplier </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Suplier</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.suplier.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Suplier</label>
                                        <input class="form-control @error('nama_suplier') is-invalid @enderror " type="text"
                                            name="nama_suplier" value="{{ old('nama_suplier') }}"
                                            placeholder="Nama Suplier">
                                        @error('nama_suplier')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <input class="form-control @error('kota') is-invalid @enderror " type="text"
                                            name="kota" value="{{ old('kota') }}" placeholder="Kota">
                                        @error('kota')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Telpon</label>
                                        <input class="form-control @error('no_telp') is-invalid @enderror " type="text"
                                            name="no_telp" value="{{ old('no_telp') }}" placeholder="Nomor Telpon">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror " name="alamat" placeholder="Alamat Lengkap"
                                            rows="4">{{ old('alamat') }}</textarea>
                                        @error('alamat')
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
