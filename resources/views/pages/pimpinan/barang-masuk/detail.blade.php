@extends('layouts.admin')

@section('title', 'Barang Masuk')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Detail Barang Masuk</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Detail Barang Masuk </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('pimpinan.barang-masuk.index') }}" class="btn btn-light btn-air-light">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('pimpinan.barang-masuk.printDetail', $data->id_barang_masuk) }}"
                            class="btn btn-light btn-air-light" target="_blank">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            <span>Detail Barang Masuk</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <tr>
                                    <th width="200px">Tanggal Masuk</th>
                                    <td>{{ Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                                </tr>
                                <tr>
                                    <th width="200px">Suplier</th>
                                    <td>{{ $data->suplier->nama_suplier }}</td>
                                </tr>
                                <tr>
                                    <th width="200px">Detail Barang Masuk</th>
                                    <td>
                                        <table class="display table table-bordered" id="table">
                                            <thead>
                                                <tr>
                                                    <th width="50px">No.</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kode Barang</th>
                                                    <th>Jumlah Masuk</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->detail_barang_masuk as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            {{ App\Models\Barang::find($value->barang_id)->nama_barang }}
                                                        </td>
                                                        <td>
                                                            {{ App\Models\Barang::find($value->barang_id)->kode_barang }}
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
