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

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Data Aset</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.aset.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Foto Aset</h6>
                                    <img src="{{ asset('storage/barang/' . $data->foto_path) }}"
                                        alt="foto{{ $data->nama }}" width="200px">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Nama Aset</label>
                                                <input type="text" class="form-control" value="{{ $data->nama }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kode Aset</label>
                                                <input type="text" class="form-control" value="{{ $data->kode }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nomor Register</label>
                                                <input type="text" class="form-control" value="{{ $data->register }}"
                                                    disabled>
                                            </div>
                                        </div>

                                        @if ($data->jenis === 'kendaraanDinas')
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor BPKB</label>
                                                    <input type="text" class="form-control" value="{{ $data->no_bpkb }}"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor Polisi</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->no_polisi }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor Rangka</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->no_rangka }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nomor Mesin</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $data->no_mesin }}" disabled>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kondisi</label>
                                                <select name="kondisi" id="kondisi"
                                                    class="form-control @error('kondisi') is-invalid @enderror">
                                                    <option value="">Pilih Kondisi</option>
                                                    <option value="baik"
                                                        {{ $data->kondisi == 'baik' ? 'selected' : '' }}>
                                                        Baik
                                                    </option>
                                                    <option value="cukup_baik"
                                                        {{ $data->kondisi == 'cukup_baik' ? 'selected' : '' }}>
                                                        Cukup Baik
                                                    </option>
                                                    <option value="rusak_berat"
                                                        {{ $data->kondisi == 'rusak_berat' ? 'selected' : '' }}>
                                                        Rusak Berat
                                                    </option>
                                                </select>
                                                @error('kondisi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Jenis Kepemilikan</label>
                                                <select name="jenis_kepemilikan" id="jenisKepemilikan"
                                                    class="form-control select2js @error('jenis_kepemilikan') is-invalid @enderror">
                                                    <option value="null">Pilih ...</option>
                                                    <option value="ruangan"
                                                        {{ $data->jenis_kepemilikan == 'ruangan' ? 'selected' : '' }}>
                                                        Ruangan
                                                    </option>
                                                    <option value="pegawai"
                                                        {{ $data->jenis_kepemilikan == 'pegawai' ? 'selected' : '' }}>
                                                        Pegawai
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="optionRuangan">
                                                <label>Ruangan</label>
                                                <select name="ruangan_id" id="ruanganSelect2Js"
                                                    class="form-control select2js @error('ruangan_id') is-invalid @enderror">
                                                    <option></option>
                                                    @foreach ($ruangan as $r)
                                                        <option value="{{ $r->id_ruangan }}"
                                                            {{ $r->id_ruangan == $data->ruangan_id ? 'selected' : '' }}>
                                                            {{ $r->nama_ruangan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ruangan_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="optionPegawai">
                                                <label for="">Pegawai</label>
                                                <select name="pegawai_id" id="pegawaiSelect2Js"
                                                    class="form-control select2js @error('pegawai_id') is-invalid @enderror">
                                                    <option></option>
                                                    @foreach ($pegawai as $r)
                                                        <option value="{{ $r->id_pegawai }}"
                                                            {{ $r->id_pegawai == $data->pegawai_id ? 'selected' : '' }}>
                                                            {{ $r->nama_pegawai }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pegawai_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info float-right" type="submit">
                                Perbarui
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('tambahStyle')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush

@push('tambahScript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            var jenisKepemilikan = $('#jenisKepemilikan').find(":selected").val();
            var option = jenisKepemilikan;

            if (option == 'ruangan') {
                $('#optionPegawai').css('display', 'none')
            } else {
                $('#optionRuangan').css('display', 'none')
            }

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
            });

            $('#pegawaiSelect2Js, #jenisKepemilikan, #ruanganSelect2Js').select2({
                placeholder: "Pilih ...",
                theme: 'bootstrap4',
            });

        });
    </script>
@endpush
