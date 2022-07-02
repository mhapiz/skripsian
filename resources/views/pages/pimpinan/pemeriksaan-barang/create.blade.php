@extends('layouts.admin')

@section('title', 'Pemeriksaan Barang')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pemeriksaan Barang</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Pemeriksaan Barang </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Pemeriksaan Barang</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pemeriksaan-barang.store') }}" method="POST"
                            id="formPemeriksaanBarang">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Detail Barang Masuk</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pilih Barang Masuk

                                                </label>
                                                <select name="barang_masuk_id" id="select2"
                                                    class="form-control @error('barang_masuk_id') is-invalid @enderror ">
                                                    <option></option>
                                                    @foreach ($barang_masuk as $bm)
                                                        <option value="{{ $bm->id_barang_masuk }}"
                                                            {{ Session::get('barang_masuk_id') == $bm->id_barang_masuk ? 'selected' : '' }}>
                                                            {{ Carbon\Carbon::parse($bm->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                                            -
                                                            {{ $bm->suplier->nama_suplier }} -
                                                            {{ number_format($bm->total_harga, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('barang_masuk_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                {{ Session::forget('barang_masuk_id') }}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nomor Pemeriksaan</label>
                                                <input class="form-control @error('no_pemeriksaan') is-invalid @enderror "
                                                    type="text" name="no_pemeriksaan" placeholder="Nomor Pemeriksaan"
                                                    value="{{ App\Models\PemeriksaanBarang::orderBy('created_at', 'desc')->first() != null ? str_pad(App\Models\PemeriksaanBarang::orderBy('created_at', 'desc')->first()->no_pemeriksaan + 1, 3, '0', STR_PAD_LEFT) : str_pad('1', 3, '0', STR_PAD_LEFT) }}">
                                                @error('no_pemeriksaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tanggal Pemeriksaan</label>
                                                <input
                                                    class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror "
                                                    id="tanggal" type="text" name="tanggal_pemeriksaan"
                                                    value="{{ old('tanggal_pemeriksaan') }}"
                                                    placeholder="Tanggal Pemeriksaan">
                                                @error('tanggal_pemeriksaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Pemeriksa</h4>
                                        </div>
                                    </div>
                                    <hr>

                                    {{--  --}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Pemeriksa 1</label>
                                                <select name="pemeriksa_1" id="pemeriksa1"
                                                    class="form-control @error('pemeriksa_1') is-invalid @enderror">
                                                    <option></option>
                                                    @foreach ($pegawai as $p)
                                                        <option value="{{ $p->nama_pegawai }}"
                                                            {{ old('pemeriksa_1') == $p->nama_pegawai ? 'selected' : '' }}>
                                                            {{ $p->nama_pegawai }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pemeriksa_1')
                                                    <div class="invalid-feedback ">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <h6 class="mt-2">Ketua</h6>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Pemeriksa 2</label>
                                                <select name="pemeriksa_2" id="pemeriksa2"
                                                    class="form-control @error('pemeriksa_2') is-invalid @enderror">
                                                    <option></option>
                                                    @foreach ($pegawai as $p)
                                                        <option value="{{ $p->nama_pegawai }}"
                                                            {{ old('pemeriksa_2') == $p->nama_pegawai ? 'selected' : '' }}>
                                                            {{ $p->nama_pegawai }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pemeriksa_2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <h6 class="mt-2">Anggota</h6>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>Pemeriksa 3</label>
                                                <select name="pemeriksa_3" id="pemeriksa3"
                                                    class="form-control @error('pemeriksa_3') is-invalid @enderror">
                                                    <option></option>
                                                    @foreach ($pegawai as $p)
                                                        <option value="{{ $p->nama_pegawai }}"
                                                            {{ old('pemeriksa_3') == $p->nama_pegawai ? 'selected' : '' }}>
                                                            {{ $p->nama_pegawai }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pemeriksa_3')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <h6 class="mt-2">Anggota</h6>
                                        </div>
                                    </div>
                                    {{--  --}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit" form="formPemeriksaanBarang">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('tambahStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba/assets/css/vendors/select2.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('tambahScript')
    <script src="{{ asset('cuba/assets/js/select2/select2.full.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script>
        $(document).ready(function() {
            $("#select2").select2({
                placeholder: "Tanggal - Suplier - Total Pembelian ",
                readonly: true,
            });

            $("#pemeriksa1, #pemeriksa2, #pemeriksa3").select2({
                placeholder: "Pilih ... ",
                readonly: true,
            });

            flatpickr.localize(flatpickr.l10ns.id);
            $('#tanggal').flatpickr({
                allowInput: true,
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush
