@extends('layouts.admin')

@section('title', 'Laporan Barang Masuk')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Laporan Barang Masuk</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Laporan Barang Masuk </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Laporan Barang Masuk</h5>

                        <div class="d-flex">
                            <a href="javascript:void()" class="btn btn-light btn-air-light mr-2" data-toggle="modal"
                                data-target="#exampleModal">

                                <span>Cetak Rekap Laporan</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end  ">
                            <div class="col-2">
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" id="tahun" class="form-control" value="{{ date('Y') }}">
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="javascript:void()" id="filterBtn" class="btn btn-light btn-air-light btn-block">
                                    Filter
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th width="20px">No.</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th width="300px">Total Belanja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pimpinan.laporan-barang-masuk.printRekap') }}" method="POST" id="formPrint">
                        @csrf
                        <div class="form-group">
                            <label for="">Masukkan Tahun</label>
                            <input type="text" class="form-control" value="{{ date('Y') }}" name="tahun">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="formPrint" class="btn btn-primary">Cetak</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush

@push('tambahScript')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            load_data();

            function load_data(bulan = '', tahun = new Date().getFullYear()) {
                $('#table').DataTable({
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                        "sEmptyTable": "Tidads"
                    },
                    processing: true,
                    serverside: true,
                    ajax: {
                        url: "{{ route('pimpinan.laporan-barang-masuk.getData') }}",
                        data: {
                            bulan: bulan,
                            tahun: tahun,
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'year',
                            name: 'year'
                        },
                        {
                            data: 'month',
                            name: 'month'
                        },
                        {
                            data: 'total_belanja',
                            name: 'total_belanja'
                        },

                    ]
                });
            }

            $('#filterBtn').click(function() {
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                if (bulan != '') {
                    $('#table').DataTable().destroy();
                    load_data(bulan, tahun);
                } else {
                    $('#table').DataTable().destroy();
                    load_data();
                }
            });

        });
    </script>
@endpush
