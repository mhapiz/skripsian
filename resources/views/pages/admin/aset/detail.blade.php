@extends('layouts.admin')

@section('title', 'Aset')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Aset</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Aset </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h5>Detail Aset</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width: 320px !important">
                                    <h6>Foto Aset</h6>
                                    <img src="{{ asset('storage/barang/' . $data->foto_path) }}"
                                        alt="foto{{ $data->nama }}" width="200px">
                                </td>
                                <td rowspan="2">
                                    <table class="display table table-bordered" id="table">
                                        <tr>
                                            <th width="200px">Nama Aset</th>
                                            <td>{{ $data->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <td>{{ $data->kode }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Register</i></th>
                                            <td>{{ $data->register }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kondisi</i></th>
                                            <td>{{ ucwords(str_replace('_', ' ', $data->kondisi)) }} </td>
                                        </tr>

                                        @if ($data->jenis === 'kendaraanDinas')
                                            <tr>
                                                <th>Nomor BPKB</i></th>
                                                <td>{{ $data->no_bpkb }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Polisi</i></th>
                                                <td>{{ $data->no_polisi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Rangka</i></th>
                                                <td>{{ $data->no_rangka }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Mesin</i></th>
                                                <td>{{ $data->no_mesin }}</td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th>Jenis Kepemilikan</th>
                                            <td>
                                                {{ ucwords($data->jenis_kepemilikan) }}
                                            </td>
                                        </tr>

                                        @if ($data->jenis_kepemilikan === 'ruangan')
                                            <tr>
                                                <th>Ruangan</th>
                                                <td>
                                                    {{ $data->ruangan->nama_ruangan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Penanggung Jawab Ruangan</th>
                                                <td>
                                                    {{ $data->ruangan->pegawai ? $data->ruangan->pegawai->nama_pegawai : '-' }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>Nama Pegawai</th>
                                                <td>
                                                    {{ $data->pegawai->nama_pegawai }}
                                                </td>
                                            </tr>
                                        @endif

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6>QR Code Aset</h6>
                                    {{ QrCode::size(200)->generate(route('inventaris-detail', md5($data->id_aset))) }}
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('admin.aset.edit', $data->id) }}" class="btn btn-warning mt-2">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
