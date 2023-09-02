@extends('layouts.admin')

@section('title', 'Kendaraan Dinas')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Kendaraan Dinas</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Kendaraan Dinas </li>
                    </ol>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.aset.store') }}" method="POST" id="formBarangMasuk" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis" value="kendaraanDinas">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Data Kendaraan Dinas</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4 d-flex justify-content-end">
                                <div class="col-2 d-flex align-items-center justify-content-end">
                                    <a href="#" class="btn btn-success " id="btnTambah">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                </div>

                            </div>
                            <hr>
                            <div class="box" id="wrapper">
                                <div class="row aset-row border-bottom pt-2 pb-1">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <img src="{{ asset('storage/assets/img/default.jpg') }}" width="100%"
                                                id="foto_path">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('foto_path.*') is-invalid @enderror"
                                                    name="foto_path[]" required
                                                    onchange="document.getElementById('foto_path').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label">Pilih foto...</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Aset</label>
                                                    <input class="form-control @error('nama.*') is-invalid @enderror"
                                                        type="text" required name="nama[]" placeholder="Aset">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Aset</label>
                                                    <input class="form-control @error('kode.*') is-invalid @enderror"
                                                        type="text" required name="kode[]" placeholder="Kode Aset">
                                                </div>
                                                <div class="form-group">
                                                    <label>Merk</label>
                                                    <input class="form-control @error('merk.*') is-invalid @enderror"
                                                        type="text" required name="merk[]" placeholder="Merk">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea name="keterangan[]" rows="8" class="form-control @error('keterangan.*') is-invalid @enderror"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">No. BPKB</label>
                                                    <input type="text" required name="no_bpkb[]" id="no_bpkb"
                                                        class="form-control @error('no_bpkb.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">No. Polisi</label>
                                                    <input type="text" required name="no_polisi[]" id="no_polisi"
                                                        class="form-control @error('no_polisi.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">No. Rangka</label>
                                                    <input type="text" required name="no_rangka[]" id="no_rangka"
                                                        class="form-control @error('no_rangka.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">No. Mesin</label>
                                                    <input type="text" required name="no_mesin[]" id="no_mesin"
                                                        class="form-control @error('no_mesin.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Masuk</label>
                                                    <input type="number" required name="jumlah_masuk[]"
                                                        id="jumlah_masuk"
                                                        class="form-control @error('jumlah_masuk.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Kondisi</label>
                                                    <select required name="kondisi[]" id="kondisi"
                                                        class="form-control @error('kondisi.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                        <option value="">Pilih Kondisi</option>
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Harga Satuan</label>
                                                    <input type="number" required name="harga_satuan[]"
                                                        id="harga_satuan"
                                                        class="form-control @error('harga_satuan.*') is-invalid @enderror"
                                                        form="formBarangMasuk">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit" form="formBarangMasuk"
                                id="submitButton">
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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

            $("#submitButton").click(function() {
                var button = $(this);
                button.prop("disabled", true);
                button.html("Memproses...");
                // You can also perform any additional actions here, like form submission
                // For example:
                $("#formBarangMasuk").submit();
            });
            var max_fields = 10;
            var wrapper = $("#wrapper");
            var add_button = $("#btnTambah");

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(`
                    <div class="row aset-row border-bottom pt-4 pb-1">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Foto</label>
                                <img src="{{ asset('storage/assets/img/default.jpg') }}" width="100%"
                                    id="foto_path${x}">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input @error('foto_path.*') is-invalid @enderror"
                                        name="foto_path[]" required
                                        onchange="document.getElementById('foto_path${x}').src = window.URL.createObjectURL(this.files[0])">
                                    <label class="custom-file-label">Pilih foto...</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Aset</label>
                                        <input class="form-control @error('nama.*') is-invalid @enderror"
                                            type="text" required name="nama[]" placeholder="Aset">
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Aset</label>
                                        <input class="form-control @error('kode.*') is-invalid @enderror"
                                            type="text" required name="kode[]" placeholder="Kode Aset">
                                    </div>
                                    <div class="form-group">
                                        <label>Merk</label>
                                        <input class="form-control @error('merk.*') is-invalid @enderror"
                                            type="text" required name="merk[]" placeholder="Merk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan[]" rows="8"
                                            class="form-control @error('keterangan.*') is-invalid @enderror"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">No. BPKB</label>
                                        <input type="text" required name="no_bpkb[]" id="no_bpkb"
                                            class="form-control @error('no_bpkb.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">No. Polisi</label>
                                        <input type="text" required name="no_polisi[]" id="no_polisi"
                                            class="form-control @error('no_polisi.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">No. Rangka</label>
                                        <input type="text" required name="no_rangka[]" id="no_rangka"
                                            class="form-control @error('no_rangka.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">No. Mesin</label>
                                        <input type="text" required name="no_mesin[]" id="no_mesin"
                                            class="form-control @error('no_mesin.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Jumlah Masuk</label>
                                        <input type="number" required name="jumlah_masuk[]" id="jumlah_masuk"
                                            class="form-control @error('jumlah_masuk.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kondisi</label>
                                        <select required name="kondisi[]" id="kondisi"
                                            class="form-control @error('kondisi.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                            <option value="">Pilih Kondisi</option>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Harga Satuan</label>
                                        <input type="number" required name="harga_satuan[]" id="harga_satuan"
                                            class="form-control @error('harga_satuan.*') is-invalid @enderror"
                                            form="formBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-1 d-flex align-items-center justify-content-center pt-2">
                                    <a href="#" class="btn btn-danger btn-block text-center p-1 d-flex align-items-center justify-content-center" id="btnHapus">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
            `); //add input box
                }
            });



            $(wrapper).on("click", "#btnHapus", function(e) { //user click on remove text
                e.preventDefault();
                $(this).closest('.aset-row').remove();
                x--;
            });

        });
    </script>
@endpush
