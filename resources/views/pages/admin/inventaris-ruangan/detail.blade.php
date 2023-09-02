@extends('layouts.admin')

@section('title', 'Aset Ruangan')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Aset Ruangan</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Aset Ruangan </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Detail Aset Ruangan</h5>

                        <a href="{{ route('admin.inventaris-ruangan.printDetail', $data->id_ruangan) }}"
                            class="btn btn-light btn-air-light" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            <span>Detail Aset Ruangan</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <tr>
                                    <th width="250px">Nama Ruangan</th>
                                    <td>{{ $data->nama_ruangan }}</td>
                                </tr>
                                <tr>
                                    <th width="250px">Penanggung Jawab Ruangan</th>
                                    <td>{{ $data->pegawai ? $data->pegawai->nama_pegawai : '-' }}</td>
                                </tr>
                                <tr>
                                    <th width="250px">Barang Inventaris</th>
                                    <td>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="50px">No.</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kode Barang + Register</th>
                                                    <th>Kondisi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->aset as $aset)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $aset->nama }}
                                                        </td>
                                                        <td>
                                                            {{ $aset->kode }}
                                                            -
                                                            {{ $aset->register }}
                                                        </td>
                                                        <td>
                                                            @if ($aset->kondisi == 'baik')
                                                                <div class="badge badge-pill badge-success">Baik</div>
                                                            @elseif ($aset->kondisi == 'cukup_baik')
                                                                <div class="badge badge-pill badge-light">Cukup Baik</div>
                                                            @elseif ($aset->kondisi == 'rusak')
                                                                <div class="badge badge-pill badge-warning">Rusak</div>
                                                            @elseif ($aset->kondisi == 'rusak_berat')
                                                                <div class="badge badge-pill badge-danger">Rusak Berat</div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
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
