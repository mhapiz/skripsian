@extends('layouts.admin')

@section('title', 'Aset Masuk')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Aset Masuk</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Aset Masuk </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Aset Masuk</h5>
                        <div>
                            <a href="{{ route('admin.aset-masuk.printRekap') }}" class="btn btn-light btn-air-light"
                                target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span>Rekap Barang</span>
                            </a>
                            <a href="{{ route('admin.aset-masuk.create') }}" class="btn btn-light btn-air-light">
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th width="20px">No.</th>
                                        <th>Nomor</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Suplier</th>
                                        <th>Total Harga</th>
                                        <th width="50px">Aksi</th>
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
@endsection

@push('tambahStyle')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush

@push('tambahScript')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script>
        function htmlDecode(data) {
            var txt = document.createElement('textarea');
            txt.innerHTML = data;
            return txt.value
        }


        $(document).ready(function() {
            $('#table').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                    "sEmptyTable": "Tidads"
                },
                processing: true,
                serverside: true,
                ajax: "{{ route('admin.aset-masuk.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'suplier',
                        name: 'suplier'
                    },
                    {
                        data: 'total_harga',
                        name: 'total_harga'
                    },
                    {
                        data: "aksi",
                        render: function(data) {
                            return htmlDecode(data);
                        }
                    }

                ]
            });

        });
    </script>
@endpush
