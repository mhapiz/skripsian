@extends('layouts.admin')

@section('title', 'Inventaris')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Inventaris</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('pimpinan.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Inventaris </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Tabel Data Inventaris</h5>

                        <div class="d-flex">
                            <button type="button" class="btn btn-light btn-air-light" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span>Rekap Inventaris</span>

                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-end  ">
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="ruangan" id="ruangan" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="-">Belum Ditempatkan</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id_ruangan }}">
                                                {{ $r->nama_ruangan }}</option>
                                        @endforeach
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
                                        <th>Nama Barang</th>
                                        <th>Kode Barang + No. Reg</th>
                                        <th>Kondisi</th>
                                        <th>Ruangan</th>
                                        <th width="50px">Aksi</th>
                                        {{-- <th>QR Code</th> --}}

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
                    <h5 class="modal-title" id="exampleModalLabel">Filter Barang Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pimpinan.inventaris.printRekap') }}" method="POST" id="exportForm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Kondisi Barang</label>
                                    <select name="kondisi" class="form-control" form="exportForm">
                                        <option value="">Semua</option>
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
        $('#tanggal').flatpickr({
            allowInput: true,
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });
    </script>
    <script>
        $(document).ready(function() {

            function htmlDecode(data) {
                var txt = document.createElement('textarea');
                txt.innerHTML = data;
                return txt.value
            }

            loadData();

            function loadData(ruangan = '') {
                $('#table').DataTable({
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json",
                        "sEmptyTable": "Tidads"
                    },
                    processing: true,
                    serverside: true,
                    ajax: {
                        url: "{{ route('pimpinan.inventaris.getData') }}",
                        data: {
                            ruangan: ruangan,
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_barang',
                            name: 'nama_barang'
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
                            data: 'ruangan',
                            name: 'ruangan'
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
