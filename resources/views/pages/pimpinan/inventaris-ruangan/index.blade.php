@extends('layouts.admin')

@section('title', 'Inventaris Ruangan')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Inventaris Ruangan</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Inventaris Ruangan </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Inventaris Ruangan</h5>

                        <div class="d-flex ">
                            <a href="{{ route('pimpinan.inventaris-ruangan.printRekap') }}"
                                class="btn btn-light btn-air-light mx-2 " target="_blank">
                                Print Rekap
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Ruangan</th>
                                        <th>Penanggung Jawab Ruangan</th>
                                        <th>Jumlah Barang Inventaris</th>
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
        $(document).ready(function() {

            function htmlDecode(data) {
                var txt = document.createElement('textarea');
                txt.innerHTML = data;
                return txt.value
            }

            $('#table').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                    "sEmptyTable": "Tidads"
                },
                processing: true,
                serverside: true,
                ajax: "{{ route('pimpinan.inventaris-ruangan.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_ruangan',
                        name: 'nama_ruangan'
                    },
                    {
                        data: 'pegawai',
                        name: 'pegawai'
                    },
                    {
                        data: 'jumlah_barang_inventaris',
                        name: 'jumlah_barang_inventaris'
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
