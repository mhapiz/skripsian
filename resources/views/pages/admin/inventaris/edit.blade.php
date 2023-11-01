@extends('layouts.admin')

@section('title', 'Inventaris')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Inventaris</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Inventaris </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Data Inventaris</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.inventaris.update', $data->id_inventaris) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Nama Barang</label>
                                        <input type="text" class="form-control"
                                            value="{{ $data->barang->nama_barang }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input type="text" class="form-control"
                                            value="{{ $data->barang->kode_barang }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Register</label>
                                        <input type="text" class="form-control" value="{{ $data->register }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kondisi</label>
                                        <select name="kondisi" id="kondisi"
                                            class="form-control @error('kondisi') is-invalid @enderror">
                                            <option value="">Pilih Kondisi</option>
                                            <option value="baik" {{ $data->kondisi == 'baik' ? 'selected' : '' }}>
                                                Baik
                                            </option>
                                            <option value="cukup_baik"
                                                {{ $data->kondisi == 'cukup_baik' ? 'selected' : '' }}>
                                                Cukup Baik
                                            </option>
                                            <option value="rusak_berat"
                                                {{ $data->kondisi == 'rusak_berat' ? 'selected' : '' }}>
                                                Rusak Berat
                                            </option>
                                        </select>
                                        @error('kondisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <select name="ruangan_id" id="select2js"
                                            class="form-control @error('kondisi') is-invalid @enderror">
                                            <option></option>
                                            @foreach ($ruangan as $r)
                                                <option value="{{ $r->id_ruangan }}"
                                                    {{ $r->id_ruangan == $data->ruangan_id ? 'selected' : '' }}>
                                                    {{ $r->nama_ruangan }}</option>
                                            @endforeach
                                        </select>
                                        @error('kondisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush

@push('tambahScript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#select2js').select2({
            placeholder: "Pilih ...",
            theme: 'bootstrap4',
        });
    </script>
@endpush
