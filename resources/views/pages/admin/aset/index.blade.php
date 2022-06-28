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
                            <a href="{{ route('admin.aset.printRekap') }}" class="btn btn-light btn-air-light mr-2"
                                target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span>Rekap Aset</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset + No. Reg</th>
                                        <th>Kondisi</th>
                                        <th>Keterangan</th>
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
                ajax: "{{ route('admin.aset.getData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_aset',
                        name: 'nama_aset'
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
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: "aksi",
                        render: function(data) {
                            return htmlDecode(data);
                        }
                    }

                ]
            });
            // ----

            var max_fields = 10;
            var wrapper = $("#wrapper");
            var add_button = $("#btnTambah");
            var delete_button = $("#btnHapus");
            var component2 = $('.comp2');
            var component3 = $('.comp3');
            var component4 = $('.comp4');
            var component5 = $('.comp5');

            component2.remove();
            component3.remove();
            component4.remove();
            component5.remove();

            var x = 2; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                switch (x) {
                    case 2:
                        $(wrapper).append(component2);
                        break;
                    case 3:
                        $(wrapper).append(component3);
                        break;
                    case 4:
                        $(wrapper).append(component4);
                        break;
                    case 5:
                        $(wrapper).append(component5);
                        break;
                    default:
                        break;
                }
                // if (x < max_fields) { //max input box allowed
                // }
                x++; //text box increment
                if (x >= 6) {
                    x = 6
                }
            });

            $(delete_button).click(function(e) { //user click on remove text
                e.preventDefault();
                switch (x) {
                    case 3:
                        component2.remove();
                        break;
                    case 4:
                        component3.remove();
                        break;
                    case 5:
                        component4.remove();
                        break;
                    case 6:
                        component5.remove();
                        break;
                    default:
                        break;
                }
                x--;
                if (x <= 2) {
                    x = 2
                }
            });

        });
    </script>
@endpush
