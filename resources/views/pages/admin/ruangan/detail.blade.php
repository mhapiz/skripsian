@extends('layouts.admin')

@section('title', 'Ruangan')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Ruangan</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Ruangan </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Detail Ruangan</h5>

                        <a href="{{ route('admin.ruangan.printDetail', $data->id_ruangan) }}"
                            class="btn btn-light btn-air-light" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            <span>Detail Ruangan</span>
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
                                    <td>{{ $data->pegawai->nama_pegawai }}</td>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->inventaris as $inven)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ App\Models\Barang::find($inven->barang_id)->nama_barang }}
                                                        </td>
                                                        <td>
                                                            {{ App\Models\Barang::find($inven->barang_id)->kode_barang }}
                                                            -
                                                            {{ $inven->register }}
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
