@extends('layouts.admin')

@section('title', 'Mutasi')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Mutasi</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Mutasi </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form action="{{ route('admin.mutasi.distribusiAksi') }}" method="POST" id="distribusiForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis Kepemilikan</label>
                                    <select name="jenis_kepemilikan" id="jenisKepemilikan"
                                        class="form-control select2jsDistribusi @error('jenis_kepemilikan') is-invalid @enderror"
                                        form="distribusiForm">
                                        <option value="null">Pilih ...</option>
                                        <option value="ruangan">Ruangan</option>
                                        <option value="pegawai">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="optionRuangan">
                                    <label for="">Ruangan</label>
                                    <select name="ruangan_id" id=""
                                        class="form-control select2js @error('ruangan_id') is-invalid @enderror"
                                        form="distribusiForm">
                                        <option></option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id_ruangan }}">
                                                {{ $r->nama_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="optionPegawai">
                                    <label for="">Pegawai</label>
                                    <select name="pegawai_id" id=""
                                        class="form-control select2js @error('pegawai_id') is-invalid @enderror"
                                        form="distribusiForm">
                                        <option></option>
                                        @foreach ($pegawai as $r)
                                            <option value="{{ $r->id_pegawai }}">
                                                {{ $r->nama_pegawai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        <input type="hidden" name="jumlahAset" value="1" id="jumlahAset" readonly>

                        <h5>Detail Barang Aset</h5>

                        <hr>

                        <div id="wrapper">
                            <div class="comp-ori">
                                @livewire('fetch-jumlah-barang-inventaris-live', ['aset_id' => null, 'idx' => 1])
                            </div>
                            <div class="comp2">
                                @livewire('fetch-jumlah-barang-inventaris-live', ['aset_id' => null, 'idx' => 2])
                            </div>
                            <div class="comp3">
                                @livewire('fetch-jumlah-barang-inventaris-live', ['aset_id' => null, 'idx' => 3])
                            </div>
                            <div class="comp4">
                                @livewire('fetch-jumlah-barang-inventaris-live', ['aset_id' => null, 'idx' => 4])
                            </div>
                            <div class="comp5">
                                @livewire('fetch-jumlah-barang-inventaris-live', ['aset_id' => null, 'idx' => 5])
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-2">
                                <a href="#" class="btn btn-danger btn-block" id="btnHapus">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-success btn-block " id="btnTambah">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary float-right" type="submit" form="distribusiForm"
                                    id="submitButton">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('tambahStyle')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .hidden-comp {
            display: none;
        }
    </style>
@endpush

@push('tambahScript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
        integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
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

            flatpickr.localize(flatpickr.l10ns.id);
            $('#tanggal').flatpickr({
                allowInput: true,
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
            });

            var wrapper = $("#wrapper");
            var add_button = $("#btnTambah");
            var delete_button = $("#btnHapus");
            var component2 = $('.comp2');
            var component3 = $('.comp3');
            var component4 = $('.comp4');
            var component5 = $('.comp5');
            $(delete_button).addClass('disabled');


            component2.addClass('hidden-comp');
            component3.addClass('hidden-comp');
            component4.addClass('hidden-comp');
            component5.addClass('hidden-comp');

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                x++; //text box increment
                switch (x) {
                    case 2:
                        component2.removeClass('hidden-comp');
                        break;
                    case 3:
                        component3.removeClass('hidden-comp');
                        break;
                    case 4:
                        component4.removeClass('hidden-comp');
                        break;
                    case 5:
                        component5.removeClass('hidden-comp');
                        break;
                    default:
                        break;
                }

                if (x >= 5) {
                    x = 5
                }

                $('#jumlahAset').val(x);

                if (x == 5) {
                    $(add_button).addClass('disabled');
                } else {
                    $(add_button).removeClass('disabled');
                }

                if (x == 1) {
                    $(delete_button).addClass('disabled');
                } else {
                    $(delete_button).removeClass('disabled');
                }
            });

            $(delete_button).click(function(e) { //user click on remove text
                e.preventDefault();
                switch (x) {
                    case 2:
                        component2.addClass('hidden-comp');
                        break;
                    case 3:
                        component3.addClass('hidden-comp');
                        break;
                    case 4:
                        component4.addClass('hidden-comp');
                        break;
                    case 5:
                        component5.addClass('hidden-comp');
                        break;
                    default:
                        break;
                }
                x--;
                if (x <= 1) {
                    x = 1
                }
                $('#jumlahAset').val(x);
                if (x == 1) {
                    $(delete_button).addClass('disabled');
                } else {
                    $(delete_button).removeClass('disabled');
                }
                if (x == 5) {
                    $(add_button).addClass('disabled');
                } else {
                    $(add_button).removeClass('disabled');
                }
            });

            $('#optionRuangan').css('display', 'none')
            $('#optionPegawai').css('display', 'none')

            $('#jenisKepemilikan').change(function() {

                //get the selected val using jQuery's 'this' method and assign to a var
                var selectedVal = $(this).val();

                if (selectedVal == 'ruangan') {
                    $('#optionRuangan').css('display', 'block')
                    $('#optionPegawai').css('display', 'none')
                } else if (selectedVal == 'pegawai') {
                    $('#optionRuangan').css('display', 'none')
                    $('#optionPegawai').css('display', 'block')
                }
                //perform the rest of your operations using aforementioned var

            });
            initSelect2();
        });
    </script>
@endpush
