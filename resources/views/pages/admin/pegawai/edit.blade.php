@extends('layouts.admin')

@section('title', 'Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pegawai</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Pegawai </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Data Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pegawai.update', $data->id_pegawai) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input class="form-control @error('nama_pegawai') is-invalid @enderror "
                                            type="text" name="nama_pegawai" value="{{ $data->nama_pegawai }}"
                                            placeholder="Nama Pegawai">
                                        @error('nama_pegawai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>NIP Pegawai</label>
                                        <input class="form-control @error('nip') is-invalid @enderror " type="text"
                                            name="nip" placeholder="NIP Pegawai" value="{{ $data->nip }}">
                                        @error('nip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input class="form-control @error('jabatan') is-invalid @enderror " type="text"
                                            name="jabatan" placeholder="Jabatan" value="{{ $data->jabatan }}">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input class="form-control @error('no_hp') is-invalid @enderror " type="text"
                                            name="no_hp" placeholder="No. HP" value="{{ $data->no_hp }}">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" rows="4" class="form-control @error('alamat') is-invalid @enderror ">{{ $data->alamat }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info" type="submit">
                                Perbarui
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
