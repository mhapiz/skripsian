@extends('layouts.admin')

@section('title', 'Aset')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Aset</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Aset </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Aset</h5>

                        <div class="d-flex">
                            @livewire('export-aset')

                            <a href="{{ route('admin.mutasi.distribusi') }}" class="btn btn-light btn-air-light mx-2">
                                Mutasi
                            </a>

                            <a href="{{ route('admin.aset.create') }}" class="btn btn-light btn-air-light">
                                Tambah Aset
                            </a>

                            <a href="{{ route('admin.kendaraan-dinas.create') }}" class="btn btn-light btn-air-light ml-2">
                                Tambah Kendaraan Dinas
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end  ">
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="ruangan" id="ruangan" class="form-control">
                                        <option value="all">Semua</option>
                                        <option value="baik">
                                            Baik
                                        </option>
                                        <option value="cukup_baik">
                                            Cukup Baik
                                        </option>
                                        <option value="rusak">
                                            Rusak
                                        </option>
                                        <option value="rusak_berat">
                                            Rusak Berat
                                        </option>
                                    </select>
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
                                        <th>No.</th>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset + No. Reg</th>
                                        <th>Kondisi</th>
                                        <th>Kepemilikan</th>
                                        {{-- <th>QR Code</th> --}}
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('tambahScript')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script>
        flatpickr.localize(flatpickr.l10ns.id);
        $('#tanggal').flatpickr({
            allowInput: true,
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });

        function htmlDecode(data) {
            var txt = document.createElement('textarea');
            txt.innerHTML = data;
            return txt.value
        }
    </script>
    <script>
        $(document).ready(function() {
            window.livewire.on('exported', () => {
                $('#exportModal').modal('hide');
                $("#submitButton").click(function() {
                    $(this).text("Print");
                    $(this).prop("disabled", false);
                    $('#closeButton').prop("disabled", false);
                });
            });

            loadData("all");

            function loadData(ruangan) {
                let url = "{{ route('admin.aset.getData', ['filter' => ':filter']) }}";
                url = url.replace(':filter', ruangan);
                $('#table').DataTable({
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                        "sEmptyTable": "Tidads"
                    },
                    processing: true,
                    serverside: true,
                    ajax: {
                        url: url
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'kondisi',
                            name: 'kondisi'
                        },
                        {
                            data: 'kepemilikan',
                            name: 'kepemilikan'
                        },
                        // {
                        //     data: 'qr',
                        //     name: 'qr'
                        // },
                        {
                            data: "aksi",
                            render: function(data) {
                                return htmlDecode(data);
                            }
                        }

                    ]
                });
            }

            $('#filterBtn').click(function() {
                var ruangan = $('#ruangan').val();
                if (ruangan != '') {
                    $('#table').DataTable().destroy();
                    loadData(ruangan);
                } else {
                    $('#table').DataTable().destroy();
                    loadData();
                }
            });

        });
    </script>
@endpush
