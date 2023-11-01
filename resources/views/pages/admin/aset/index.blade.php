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
                        <a href="{{ route('admin.mutasi.distribusi') }}" class="btn btn-light btn-air-light mr-2">
                            Mutasi
                        </a>

                        @livewire('export-aset')

                        <div class="dropdown mr-2">
                            <button class="btn btn-light btn-air-light" id="dropdownMenuButton" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title=""
                                title="">
                                <i class="fa fa-print mr-2"></i>
                                Laporan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                <a style="font-size: .7rem" class="dropdown-item" href="#"
                                    data-original-title="Laporan Inventaris" title="Laporan Inventaris"
                                    data-toggle="modal" data-target="#exportInventaris">
                                    Laporan Inventaris
                                </a>
                                <a style="font-size: .7rem" class="dropdown-item" href="#"
                                    data-original-title="Kartu Inventaris Ruangan" title="Kartu Inventaris Ruangan"
                                    data-toggle="modal" data-target="#kir">
                                    Kartu Inventaris Ruangan
                                </a>
                                <a style="font-size: .7rem" class="dropdown-item" href="#"
                                    data-original-title="Pakta Integritas" title="Pakta Integritas" data-toggle="modal"
                                    data-target="#paktaInt">
                                    Pakta Integritas
                                </a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-light btn-air-light" id="dropdownMenuButton" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title=""
                                title="">
                                <i class="fa fa-plus mr-2"></i>
                                Tambah
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                <a style="font-size: .7rem" class="dropdown-item"
                                    href="{{ route('admin.aset.create') }}" data-original-title="Tambah Aset"
                                    title="Tambah Aset">
                                    Aset
                                </a>
                                <a style="font-size: .7rem" class="dropdown-item"
                                    href="{{ route('admin.kendaraan-dinas.create') }}"
                                    data-original-title="Tambah Kendaraan Dinas" title="Tambah Kendaraan Dinas">
                                    Kendaraan Dinas
                                </a>
                            </div>
                        </div>
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

<div class="modal fade" id="exportInventaris" aria-labelledby="exportInventarisLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportInventarisLabel">Pilih Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.aset.exportInventaris') }}" method="post" id="exportInventarisForm"
                    target="_blank">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5>Filter</h5>
                        </div>
                        <div class="col-12">
                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                <div class="radio radio-primary">
                                    <input id="kondisi" type="radio" name="radioFilter" value="Kondisi">
                                    <label class="mb-0" for="kondisi">
                                        Kondisi
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input id="Tahun" type="radio" name="radioFilter" value="Tahun">
                                    <label class="mb-0" for="Tahun">
                                        Tahun
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input id="Barang" type="radio" name="radioFilter" value="Barang">
                                    <label class="mb-0" for="Barang">
                                        Barang
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input id="Penanggung Jawab" type="radio" name="radioFilter"
                                        value="Penanggung Jawab">
                                    <label class="mb-0" for="Penanggung Jawab">
                                        Penanggung Jawab
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-group" id="inputKondisi">
                                <label>Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control">
                                    <option value="">Pilih Kondisi</option>
                                    <option value="baik">
                                        Baik
                                    </option>
                                    <option value="cukup_baik">
                                        Cukup Baik
                                    </option>
                                    <option value="rusak_berat">
                                        Rusak Berat
                                    </option>
                                </select>
                            </div>
                            <div class="form-group" id="inputTahun">
                                <label>Tahun</label>
                                <input type="text" class="form-control" name="tahun">
                            </div>
                            <div class="form-group" id="inputBarang">
                                <label>Nama Aset</label>
                                <select class="form-control select2jsExportInventaris" id="aset_id" name="aset_id">
                                    <option value=""></option>
                                    @foreach ($uniqueAset as $aset)
                                    <option value="{{ $aset->id }}">{{ $aset->nama }} - {{ $aset->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="inputPenanggungJawab">
                                <label>Nama Pegawai</label>
                                <select class="form-control select2jsExportInventaris" id="pegawai_id"
                                    name="pegawai_id">
                                    <option value=""></option>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" >
                <div class="row" style="width: 100%">
                    <div class="col-6 d-flex">
                        <span>PDF</span>
                        <div class="switch colored mx-2">
                            <input type="checkbox" id="colored" name="isExcel" form="exportInventarisForm" value="true">
                            <label for="colored"></label>
                        </div>
                        <span>Excel</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" id="closeButton"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary submitExport"
                            form="exportInventarisForm">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kir" aria-labelledby="kirLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kirLabel">Export Kartu Inventaris Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.aset.exportKir') }}" method="post" id="exportKirForm" target="_blank">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5>Pilih Ruangan</h5>
                        </div>
                        <div class="col-12">
                            <div class="form-group"">
                                <label>Ruangan</label>
                                <select class=" form-control select2jsExportKir" id="ruangan_id" name="ruangan_id">
                                <option value=""></option>
                                @foreach ($ruangan as $r)
                                <option value="{{ $r->id_ruangan }}">{{ $r->nama_ruangan }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row" style="width: 100%">
                    <div class="col-6 d-flex">
                        <span>PDF</span>
                        <div class="switch colored mx-2">
                            <input type="checkbox" id="colored2" name="isExcel" form="exportKirForm" value="true">
                            <label for="colored2"></label>
                        </div>
                        <span>Excel</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" id="closeButton" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary submitExport" form="exportKirForm">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paktaInt" aria-labelledby="paktaIntLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paktaIntLabel">Export Pakta Integritas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.aset.exportPaktaInt') }}" method="post" id="exportPaktaIntForm"
                    target="_blank">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Pihak Pertama</label>
                                <select class="form-control select2jsExportPaktaInt" id="pihak_pertama"
                                    name="pihak_pertama">
                                    <option value=""></option>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Pihak Kedua</label>
                                <select class="form-control select2jsExportPaktaInt" id="pihak_kedua"
                                    name="pihak_kedua">
                                    <option value=""></option>
                                    @foreach ($pegawai as $p)
                                    <option value="{{ $p->id_pegawai }}">{{ $p->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary submitExport" form="exportPaktaIntForm">Print</button>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    .switch {
        display: block;
    }

    .switch input[type=checkbox] {
        display: none;
    }

    .switch input[type=checkbox]:checked+label {
        background-color: #2f7df9;
    }

    .switch input[type=checkbox]:checked+label:after {
        left: 33px;
    }

    .switch label {
        transition: all 200ms ease-in-out;
        display: inline-block;
        position: relative;
        height: 24px;
        width: 54px;
        border-radius: 24px;
        cursor: pointer;
        background-color: #ddd;
        color: transparent;
    }

    .switch label:after {
        transition: all 200ms ease-in-out;
        content: " ";
        position: absolute;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background-color: white;
        top: 3px;
        left: 3px;
        right: auto;
        box-shadow: 1px 1px 1px gray;
    }

    .switch.colored input[type=checkbox]:checked+label {
        background-color: #00A859;
    }

    .switch.colored label {
        background-color: #f34646;
    }
</style>
@endpush

@push('tambahScript')
<script src="{{ asset('assets/js/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
    integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "3000",
        "timeOut": "10000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @foreach ($errors->all() as $error)
        toastr.error("{{ $error }}");
    @endforeach

    $(document).ready(function() {

        $('.select2jsExportInventaris').select2({
            placeholder: "Pilih ...",
            theme: 'bootstrap4',
            dropdownParent: $('#exportInventaris')
        });

        $('.select2jsExportKir').select2({
            placeholder: "Pilih ...",
            theme: 'bootstrap4',
            dropdownParent: $('#kir')
        });

        $('.select2jsExportPaktaInt').select2({
            placeholder: "Pilih ...",
            theme: 'bootstrap4',
            dropdownParent: $('#paktaInt')
        });


        window.livewire.on('exported', () => {
            $('#exportInventaris').modal('hide');
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

        $('#inputKondisi').hide();
        $('#inputTahun').hide();
        $('#inputBarang').hide();
        $('#inputPenanggungJawab').hide();

        // Ketika salah satu radio button dengan nama "radio1" dipilih
        $('input[name="radioFilter"]').on('change', function() {
            // Cek nilai yang dipilih
            var selectedValue = $('input[name="radioFilter"]:checked').val();

            // Berdasarkan nilai yang dipilih
            if (selectedValue === 'Kondisi') {
                $('#inputKondisi').show();
                $('#inputTahun').hide();
                $('#inputBarang').hide();
                $('#inputPenanggungJawab').hide();
            } else if (selectedValue === 'Tahun') {
                $('#inputKondisi').hide();
                $('#inputTahun').show();
                $('#inputBarang').hide();
                $('#inputPenanggungJawab').hide();
            } else if (selectedValue === 'Barang') {
                $('#inputKondisi').hide();
                $('#inputTahun').hide();
                $('#inputBarang').show();
                $('#inputPenanggungJawab').hide();
            } else if (selectedValue === 'Penanggung Jawab') {
                $('#inputKondisi').hide();
                $('#inputTahun').hide();
                $('#inputBarang').hide();
                $('#inputPenanggungJawab').show();
            } else {
                $('#inputKondisi').hide();
                $('#inputTahun').hide();
                $('#inputBarang').hide();
                $('#inputPenanggungJawab').hide();
            }
        });

    });
</script>
@endpush
