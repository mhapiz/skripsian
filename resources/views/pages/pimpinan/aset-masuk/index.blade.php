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
                            <button type="button" class="btn btn-light btn-air-light" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span>Rekap Barang</span>
                            </button>

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
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.aset-masuk.printRekap') }}" method="POST" id="exportForm">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="text" name="dari_tanggal" id="dari_tanggal" class="form-control tanggal"
                                        form="exportForm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="text" name="sampai_tanggal" id="sampai_tanggal"
                                        class="form-control tanggal" form="exportForm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="checkBox" name="semua"
                                        form="exportForm">
                                    <label class="form-check-label" id="checkBox">Semua</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="exportForm">Export</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('tambahScript')
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script>
        flatpickr.localize(flatpickr.l10ns.id);
        $('.tanggal').flatpickr({
            allowInput: true,
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });




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


                ]
            });

            $("#checkBox").change(function() {
                if ($(this).prop("checked")) {
                    $('.tanggal').flatpickr({
                        clickOpens: false,
                        defaultDate: null,
                    });
                    $("#dari_tanggal").val('');
                    $("#sampai_tanggal").val('');
                } else {
                    $('.tanggal').flatpickr({
                        allowInput: true,
                        altInput: true,
                        altFormat: "j F Y",
                        dateFormat: "Y-m-d",
                    });
                }
            });

        });
    </script>
@endpush
