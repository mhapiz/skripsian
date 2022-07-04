@extends('layouts.admin')

@section('title', 'Barang')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Barang</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Barang </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Barang</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pimpinan.barang.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <img src="{{ asset('storage/assets/img/default.jpg') }}" width="100%"
                                            id="foto_path">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('foto_path') is-invalid @enderror"
                                                name="foto_path"
                                                onchange="document.getElementById('foto_path').src = window.URL.createObjectURL(this.files[0])">
                                            <label class="custom-file-label">Pilih foto...</label>
                                        </div>
                                        @error('foto_path')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Barang</label>
                                                <input class="form-control @error('nama_barang') is-invalid @enderror "
                                                    type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                                    placeholder="Barang">
                                                @error('nama_barang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Barang</label>
                                                <input class="form-control @error('kode_barang') is-invalid @enderror "
                                                    type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                                                    placeholder="Kode Barang">
                                                @error('kode_barang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Merk</label>
                                                <input class="form-control @error('merk') is-invalid @enderror "
                                                    type="text" name="merk" value="{{ old('merk') }}"
                                                    placeholder="Merk">
                                                @error('merk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
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
