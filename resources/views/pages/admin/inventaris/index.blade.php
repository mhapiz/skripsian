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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-light btn-air-light mx-2" data-toggle="modal"
                                data-target="#distribusiBarangModal">
                                Serah Terima
                            </button>

                            <a href="{{ route('admin.inventaris.create') }}" class="btn btn-light btn-air-light">
                                Tambah Barang
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
                                        <th>Nama Barang</th>
                                        <th>Kode Barang + No. Reg</th>
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

    <!-- Modal -->
    <div class="modal fade" id="distribusiBarangModal" tabindex="-1" aria-labelledby="distribusiBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="distribusiBarangModalLabel">Distribusi Barang Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.inventaris.distribusi') }}" method="POST" id="distribusiForm">
                        @csrf

                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nomor</label>
                                    <input type="text" name="no_serah_terima" id=""
                                        class="form-control @error('no_serah_terima') is-invalid @enderror"
                                        form="distribusiForm"
                                        value="{{ App\Models\SerahTerima::orderBy('created_at', 'desc')->first() != null
                                            ? str_pad(App\Models\SerahTerima::orderBy('created_at', 'desc')->first()->no_serah_terima + 1, 3, '0', STR_PAD_LEFT)
                                            : str_pad('1', 3, '0', STR_PAD_LEFT) }}">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="text" name="tanggal_serah_terima" id="tanggal"
                                        class="form-control @error('tanggal_serah_terima') is-invalid @enderror"
                                        form="distribusiForm" value="{{ old('tanggal_serah_terima') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Jenis Kepemilikan</label>
                                    <select name="jenis_kepemilikan" id="jenisKepemilikan"
                                        class="form-control select2js @error('jenis_kepemilikan') is-invalid @enderror"
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

                        <h5>Detail Barang Inventaris</h5>

                        <hr>

                        <div id="wrapper">
                            <div class="comp-ori">
                                <livewire:fetch-jumlah-barang-inventaris-live>
                            </div>
                            <div class="comp2">
                                <livewire:fetch-jumlah-barang-inventaris-live>
                            </div>
                            <div class="comp3">
                                <livewire:fetch-jumlah-barang-inventaris-live>
                            </div>
                            <div class="comp4">
                                <livewire:fetch-jumlah-barang-inventaris-live>
                            </div>
                            <div class="comp5">
                                <livewire:fetch-jumlah-barang-inventaris-live>
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


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="distribusiForm">Simpan</button>
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
                    <form action="{{ route('admin.inventaris.printRekap') }}" method="POST" id="exportForm">
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

        function htmlDecode(data) {
            var txt = document.createElement('textarea');
            txt.innerHTML = data;
            return txt.value
        }

        $(document).ready(function() {

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
    <script>
        $(document).ready(function() {

            loadData("all");

            function loadData(ruangan) {
                let url = "{{ route('admin.inventaris.getData', ['filter' => ':filter']) }}";
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
                console.log(selectedVal);
                //perform the rest of your operations using aforementioned var

            });


        });
    </script>
@endpush
