@extends('layouts.admin')

@section('title', 'Mutasi Barang Inventaris')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Inventaris</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Mutasi Barang Inventaris </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Mutasi Barang</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.mutasi.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Barang Inventaris</label>
                                        <select name="id_inventaris" class="form-control select2" id="selectInventaris">
                                            <option> </option>
                                            @foreach ($inventaris as $inven)
                                                <option value="{{ md5($inven->id_inventaris) }}">
                                                    {{ $inven->barang->nama_barang }} --
                                                    {{ $inven->barang->kode_barang }}
                                                    --
                                                    {{ $inven->register }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                        id="modalOpen" style="margin-top: 2rem" data-target="#scanModal">
                                        Scan Barang
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <input type="text" class="form-control" id="oldRuangan">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <h5>Mutasi Barang Inventaris</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Ruangan</label>
                                        <select name="id_ruangan" class="form-control select2">
                                            <option> </option>
                                            @foreach ($ruangan as $ruang)
                                                <option value="{{ $ruang->id_ruangan }}">
                                                    {{ $ruang->nama_ruangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="scanModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row my-5">
                        <div class="col-12">
                            <div id="reader" width="600px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba/assets/css/vendors/select2.css') }}">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
@endpush

@push('tambahScript')
    <script src="{{ asset('cuba/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>


    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);

            var scanResult = decodedText;

            // get last string after '/' on scanResult
            var lastString = scanResult.split('/').pop();

            csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('#selectInventaris').val(lastString);
            $('#selectInventaris').select2().trigger('change');

            $.ajax({
                url: "{{ route('admin.mutasi.qrValidation') }}",
                type: 'POST',
                data: {
                    '_token': csrf_token,
                    'qr': lastString,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data Inventaris Ditemukan!',
                            icon: "success",
                            button: "OK",
                        });
                        $('#scanModal').modal('hide');
                        html5QrcodeScanner.clear();
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: "Data Inventaris Tidak Diketahui!",
                            icon: "error",
                            button: "OK",
                        });
                    }

                },
            })
        }
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);

        $('#modalOpen').click(function() {
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

    <script>
        // make notification with swal
        @if (session()->has('success'))
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "success",
                button: "OK",
            });
        @endif

        // make notification with swal
        @if (session()->has('error'))
            Swal.fire({
                title: "Gagal",
                text: "{{ session()->get('error') }}",
                icon: "error",
                button: "OK",
            });
        @endif

        $(document).ready(function() {
            // html5QrcodeScanner.stop();

            $(".select2").select2({
                placeholder: "Pilih...",
            });

            $('#selectInventaris').change(function() {
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                // console.log(id);
                $.ajax({
                    url: "{{ route('admin.mutasi.getBarangInventaris') }}",
                    method: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(res) {
                        if (res) {
                            $('#oldRuangan').val(res);
                            $('#oldRuangan').prop("readonly", true);
                            // console.log(res);

                        } else {
                            $('#oldRuangan').val(null);
                            $('#oldRuangan').prop("readonly", false);
                            // console.log(res);
                        }
                    }
                });
            });


        });
    </script>
@endpush
