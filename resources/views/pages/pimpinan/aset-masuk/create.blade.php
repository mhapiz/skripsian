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

        <form action="{{ route('admin.aset-masuk.store') }}" method="POST" id="formBarangMasuk">
            @csrf
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Data Aset Masuk</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Informasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor</label>
                                        <input type="text" name="nomor" id="nomor" class="form-control"
                                            form="formBarangMasuk"
                                            value="{{ App\Models\AsetMasuk::orderBy('created_at', 'desc')->first() != null
                                                ? str_pad(App\Models\AsetMasuk::orderBy('created_at', 'desc')->first()->nomor + 1, 3, '0', STR_PAD_LEFT)
                                                : str_pad('1', 3, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <livewire:fetch-option-suplier-live />
                                </div>
                                <div class="col-md-2">
                                    <livewire:create-suplier-live />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6>Data Aset Tetap</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="box" id="wrapper">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama Aset</label>
                                            <input type="text" name="nama_aset[]" id="nama_aset"
                                                class="typeahead form-control nama_aset" form="formBarangMasuk">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Kode Aset</label>
                                            <input type="text" name="kode_aset[]" id="kode_aset" class="form-control"
                                                form="formBarangMasuk">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input type="number" name="jumlah_masuk[]" id="jumlah_masuk"
                                                class="form-control" form="formBarangMasuk">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Harga Satuan</label>
                                            <input type="number" name="harga_satuan[]" id="harga_satuan"
                                                class="form-control" form="formBarangMasuk">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan[]" rows="4" class="form-control" form="formBarangMasuk"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Kondisi</label>
                                            <input type="text" name="kondisi[]" id="kondisi" value="Baik" readonly
                                                class="form-control" form="formBarangMasuk">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-2 d-flex align-items-center ">
                                    <a href="#" class="btn btn-success " id="btnTambah">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit" form="formBarangMasuk">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('tambahStyle')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />

    <style>
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }

        .ui-autocomplete>li>div {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
    </style>
@endpush

@push('tambahScript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
        integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>

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
    </script>

    <script>
        window.livewire.on('barangSaved', () => {
            $('#addBarangLive').modal('hide');
        });

        window.livewire.on('suplierSaved', () => {
            $('#addSuplierLive').modal('hide');
        });

        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

        $('.select2js').select2({
            placeholder: "Pilih ...",
            theme: 'bootstrap4',
        });

        flatpickr.localize(flatpickr.l10ns.id);
        $('#tanggal').flatpickr({
            allowInput: true,
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            var max_fields = 10;
            var wrapper = $("#wrapper");
            var add_button = $("#btnTambah");

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                autocomplete();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(`
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nama Aset</label>
                                        <input type="text" name="nama_aset[]" id="nama_aset"
                                            class="typeahead form-control nama_aset" form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Kode Aset</label>
                                        <input type="text" name="kode_aset[]" id="kode_aset" class="form-control"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input type="number" name="jumlah_masuk[]" id="jumlah_masuk"
                                            class="form-control" form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Harga Satuan</label>
                                        <input type="number" name="harga_satuan[]" id="harga_satuan"
                                            class="form-control" form="formBarangMasuk">
                                    </div>
                                </div>

                                <div class="col-1 d-flex align-items-center justify-content-center pt-2">
                                    <a href="#" class="btn btn-danger btn-block text-center p-2 d-flex align-items-center justify-content-center" id="btnHapus">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan[]" rows="4" class="form-control" form="formBarangMasuk"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Kondisi</label>
                                        <input type="text" name="kondisi[]" id="kondisi" value="Baik" readonly
                                            class="form-control" form="formBarangMasuk">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
            `); //add input box
                }
            });

            $(wrapper).on("click", "#btnHapus", function(e) { //user click on remove text
                e.preventDefault();
                $(this).closest('.row').remove();
                x--;
            });

            $(add_button).click(function(e) {
                autocomplete();
            });

            // make function for typeahead
            function autocomplete() {
                $(".nama_aset").each(function() {
                    let nb = $(this);
                    let kb = nb.closest('.row').find('#kode_aset');
                    $(this).autocomplete({
                        onSelect: function(suggestion) {
                            $('#selected_option').html(suggestion.value);
                        },
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "{{ route('autocompleteAset') }}",
                                type: 'POST',
                                dataType: "json",
                                data: {
                                    _token: CSRF_TOKEN,
                                    search: request.term
                                },
                                success: function(data) {
                                    response(data);
                                    console.log(data);
                                }
                            });
                        },
                        select: function(event, ui) {
                            // Set selection
                            $(nb).val(ui.item.label); // display the selected text
                            $(kb).val(ui.item.kode_aset); // save selected id to input
                            return false;
                        },

                    });
                });
            }
            autocomplete();
        });
    </script>
@endpush
