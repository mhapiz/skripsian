@extends('layouts.admin')

@section('title', 'Pangkat')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pangkat</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Pangkat </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Pangkat</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pimpinan.pangkat.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pangkat</label>
                                        <input class="form-control @error('nama_pangkat') is-invalid @enderror "
                                            type="text" name="nama_pangkat" value="{{ old('nama_pangkat') }}"
                                            placeholder="Nama Pangkat">
                                        @error('nama_pangkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Golongan</label>
                                        <input class="form-control @error('golongan') is-invalid @enderror " type="text"
                                            name="golongan" value="{{ old('golongan') }}" placeholder="Nama Golongan">
                                        @error('golongan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gaji Pokok</label>
                                        <input class="form-control @error('gaji_pokok') is-invalid @enderror "
                                            type="text" name="gaji_pokok" value="{{ old('gaji_pokok') }}"
                                            placeholder="Gaji Pokok">
                                        @error('gaji_pokok')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Potongan</label>

                                        <div class="input-group is-invalid">
                                            <input class="form-control @error('potongan') is-invalid @enderror "
                                                type="text" name="potongan" value="{{ old('potongan') }}"
                                                placeholder="Potongan">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="validatedInputGroupPrepend">%</span>
                                            </div>
                                        </div>
                                        @error('potongan')
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
