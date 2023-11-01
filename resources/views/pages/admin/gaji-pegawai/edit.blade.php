@extends('layouts.admin')

@section('title', 'Gaji Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Gaji Pegawai</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Gaji Pegawai </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Data Gaji Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.gaji-pegawai.update', $data->id_gaji_pegawai) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pilih Pegawai</label>
                                        <select name="pegawai_id" id="select2"
                                            class="form-control @error('pegawai_id') is-invalid @enderror select2">
                                            <option> </option>
                                            @foreach ($pegawai as $item)
                                                <option value="{{ $item->id_pegawai }}"
                                                    {{ $item->id_pegawai == $data->pegawai_id ? 'selected' : '' }}>
                                                    {{ $item->nama_pegawai }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pegawai_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pilih Bulan</label>
                                        <select name="bulan" id="select2"
                                            class="form-control @error('bulan') is-invalid @enderror select2">
                                            <option> </option>
                                            <option value="01"{{ $data->bulan == '01' ? 'selected' : '' }}>
                                                Januari
                                            </option>
                                            <option value="02"{{ $data->bulan == '02' ? 'selected' : '' }}>
                                                Februari
                                            </option>
                                            <option value="03"{{ $data->bulan == '03' ? 'selected' : '' }}>
                                                Maret
                                            </option>
                                            <option value="04"{{ $data->bulan == '04' ? 'selected' : '' }}>
                                                April
                                            </option>
                                            <option value="05"{{ $data->bulan == '05' ? 'selected' : '' }}>
                                                Mei
                                            </option>
                                            <option value="06"{{ $data->bulan == '06' ? 'selected' : '' }}>
                                                Juni
                                            </option>
                                            <option value="07"{{ $data->bulan == '07' ? 'selected' : '' }}>
                                                Juli
                                            </option>
                                            <option value="08"{{ $data->bulan == '08' ? 'selected' : '' }}>
                                                Agustus
                                            </option>
                                            <option value="09"{{ $data->bulan == '09' ? 'selected' : '' }}>
                                                September
                                            </option>
                                            <option value="10"{{ $data->bulan == '10' ? 'selected' : '' }}>
                                                Oktober
                                            </option>
                                            <option value="11"{{ $data->bulan == '11' ? 'selected' : '' }}>
                                                November
                                            </option>
                                            <option value="12"{{ $data->bulan == '12' ? 'selected' : '' }}>
                                                Desember
                                            </option>
                                        </select>
                                        @error('bulan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tahun Perolehan</label>
                                        <input type="text" class="form-control" name="tahun"
                                            value="{{ $data->tahun }}">
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
            $(".select2").select2({
                placeholder: "Pilih ...",
            });
        });
    </script>
@endpush
