@extends('layouts.admin')

@section('title', 'Barang Inventaris')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Aset Tetap</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Aset Tetap </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h5>Detail Aset Tetap</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <tr>
                                    <th width="200px">Nama Aset</th>
                                    <td>{{ $data->nama_aset }}</td>
                                </tr>
                                <tr>
                                    <th>Kode Aset</th>
                                    <td>{{ $data->kode_aset }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Register</th>
                                    <td>{{ $data->register }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $data->kondisi }} </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{!! $data->keterangan !!} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
