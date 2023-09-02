@extends('layouts.admin')

@section('title', 'Barang Inventaris')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Barang Inventaris</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Barang Inventaris </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h5>Detail Barang Inventaris</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <tr>
                                    <th width="200px">Nama Barang</th>
                                    <td>{{ $data->barang->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Kode Barang</th>
                                    <td>{{ $data->barang->kode_barang }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Register</i></th>
                                    <td>{{ $data->register }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</i></th>
                                    <td>{{ $data->kondisi }} </td>
                                </tr>
                                <tr>
                                    <th>QR Code</i></th>
                                    <td>{{ QrCode::size(200)->generate(route('inventaris-detail', md5($data->id_inventaris))) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto Barang</th>
                                    <td>
                                        <img src="{{ asset('storage/barang/' . $data->barang->foto_path) }}"
                                            alt="foto{{ $data->barang->nama_barang }}" width="200px">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ruangan</i></th>
                                    <td>
                                        @if ($data->ruangan)
                                            {{ $data->ruangan->nama_ruangan }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Penanggung Jawab</i></th>
                                    <td>
                                        @if ($pegawai)
                                            {{ $pegawai->nama_pegawai }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a href="{{ route('admin.inventaris.edit', $data->id_inventaris) }}" class="btn btn-warning mt-2">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
