@extends('layouts.admin')

@section('title', 'Gaji Pegawai')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Gaji Pegawai</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Gaji Pegawai </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Gaji Pegawai</h5>

                        <div class="d-flex ">
                            <a href="{{ route('admin.gaji-pegawai.printRekap') }}"
                                class="btn btn-light btn-air-light mx-2 " target="_blank">
                                Print Rekap
                            </a>
                            <a href="{{ route('admin.gaji-pegawai.create') }}" class="btn btn-light btn-air-light mx-2">
                                Tambah Data
                            </a>
                            <form action="{{ route('admin.gaji-pegawai.storeMore') }}">
                                <button class="btn btn-light btn-air-light text-dark show_confirm">
                                    Tambah Gaji Bulan Ini
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pegawai</th>
                                        <th>Bulan & Tahun </th>
                                        <th>Total Gaji</th>
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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('cuba/assets/css/vendors/datatables.css') }}"> --}}
@endpush

@push('tambahScript')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('cuba/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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
                ajax: "{{ route('admin.gaji-pegawai.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'total_gaji',
                        name: 'total_gaji'
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
    <script>
        $(document).ready(function() {
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Bagikan Gaji Bulan Ini?`,
                        text: "Gaji akan dihitung berdasarkan pangkat dan golongan!",
                        icon: "info",
                        buttons: true,
                        //  dangerMode: true,
                    })
                    .then((doIt) => {
                        if (doIt) {
                            form.submit();
                        }
                    });
            });
        });
    </script>
@endpush
