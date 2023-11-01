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
                    <div class="row">

                        <div class="col-md-4">
                            <a href="{{ url()->previous() }}" class="btn btn-light btn-air-light">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <h5>Detail Aset</h5>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 320px !important">
                                <h6>Foto Aset</h6>
                                <img src="{{ asset('storage/barang/' . $data->foto_path) }}" alt="foto{{ $data->nama }}"
                                    width="200px">
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
                                            {{ $data->jenis_kepemilikan ? ucwords($data->jenis_kepemilikan) : 'Bebas' }}
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
                                    @elseif($data->jenis_kepemilikan === 'pegawai')
                                    <tr>
                                        <th>Nama Pegawai</th>
                                        <td>
                                            {{ $data->pegawai ? $data->pegawai->nama_pegawai : '-' }}
                                        </td>
                                    </tr>
                                    @endif

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>QR Code Aset</h6>
                                {{ QrCode::size(200)->generate(route('inventaris-detail', md5($data->id))) }}
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.aset.print', md5($data->id)) }}" class="btn btn-info mt-2" target="_blank">
                        Print
                    </a>
                    <a href="#" class="btn btn-secondary mt-2" data-toggle="modal" data-target="#BAST">
                        Print BAST
                    </a>
                    <a href="{{ route('admin.aset.edit', $data->id) }}" class="btn btn-warning mt-2">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="BAST" aria-labelledby="BASTLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BASTLabel">Export BAST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.aset.exportBAST') }}" method="post" id="exportBASTForm" target="_blank">
                    @csrf
                    <input type="hidden" name="id_aset" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Pihak Pertama</label>
                                <select class="form-control select2jsExportBAST" id="pihak_pertama"
                                    name="pihak_pertama">
                                    <option value=""></option>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Pihak Kedua</label>
                                <select class="form-control select2jsExportBAST" id="pihak_kedua"
                                    name="pihak_kedua">
                                    <option value=""></option>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary submitExport" form="exportBASTForm">Print</button>
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
        $(document).ready(function() {
            $('.select2jsExportBAST').select2({
                placeholder: "Pilih ...",
                theme: 'bootstrap4',
                dropdownParent: $('#BAST')
            });
        });
    </script>
@endpush
