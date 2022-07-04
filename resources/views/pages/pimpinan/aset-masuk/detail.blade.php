@extends('layouts.admin')

@section('title', 'Aset Masuk')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Aset</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Aset </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('pimpinan.aset-masuk.index') }}" class="btn btn-light btn-air-light">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('pimpinan.aset-masuk.printDetail', $data->id_aset_masuk) }}"
                            class="btn btn-light btn-air-light" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            <span>Detail Aset</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <tr>
                                    <th width="200px">Nomor Aset Masuk</th>
                                    <td>{{ $data->nomor }}</td>
                                </tr>
                                <tr>
                                    <th width="200px">Tanggal Masuk</th>
                                    <td>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                                </tr>
                                <tr>
                                    <th width="200px">Suplier</th>
                                    <td>{{ $data->suplier->nama_suplier }}</td>
                                </tr>
                                <tr>
                                    <th width="200px">Detail Aset</th>
                                    <td>
                                        <table class="display table table-bordered" id="table">
                                            <thead>
                                                <tr>
                                                    <th width="50px">No.</th>
                                                    <th>Nama Aset</th>
                                                    <th>Kode Aset</th>
                                                    <th>Jumlah Masuk</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->detail_aset_masuk as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            {{ $value->nama_aset }}
                                                        </td>
                                                        <td>
                                                            {{ $value->kode_aset }}
                                                        </td>
                                                        <td>
                                                            {{ $value->jumlah_masuk }}
                                                        </td>
                                                        <td>
                                                            {{ 'Rp ' . number_format($value->harga_satuan, 2, ',', '.') }}
                                                        </td>
                                                        <td>
                                                            {{ 'Rp ' . number_format($value->harga_satuan * $value->jumlah_masuk, 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" class="text-center font-weight-bold">Total</td>
                                                    <td>
                                                        {{ 'Rp ' . number_format($data->total_harga, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
