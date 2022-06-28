@extends('layouts.admin')

@section('title', 'Suplier')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Suplier</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Suplier </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Suplier</h5>
                        <a href="{{ route('admin.suplier.create') }}" class="btn btn-light btn-air-light">
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Suplier</th>
                                        <th>No. Telpon</th>
                                        <th>Kota</th>
                                        <th>Alamat</th>
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
                ajax: "{{ route('admin.suplier.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_suplier',
                        name: 'nama_suplier'
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp'
                    },
                    {
                        data: 'kota',
                        name: 'kota'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
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
