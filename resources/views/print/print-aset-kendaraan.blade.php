<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')
</head>

<body>

    <div class="body" style="margin-top: 10px; ">

        {{-- <table class="w-full">
            <tr>
                <td style="width: 50%">
                    <table class="w-full table table-bordered">
                        <tr>
                            <td colspan="2" style="text-align: center">Scan QR untuk mengetahui detail barang</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <img src="{{ asset('assets/img/banjar.png') }}" style="width: 100px;" alt="">
                            </td>
                            <td>
                                Gambar 2
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="text-align: center">
                                    PEMERINTAH KABUPATEN BANJAR <br>
                                    KECAMATAN MARTAPURA
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="text-align: center">
                                    KODE - REGISTER
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%">
                    <table class="w-full table table-bordered">
                        <tr>
                            <td colspan="2" style="text-align: center">Scan QR untuk mengetahui detail barang</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <img src="{{ asset('assets/img/banjar.png') }}" style="width: 100px;" alt="">
                            </td>
                            <td>
                                Gambar 2
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="text-align: center">
                                    PEMERINTAH KABUPATEN BANJAR <br>
                                    KECAMATAN MARTAPURA
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="text-align: center">
                                    KODE - REGISTER
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> --}}
        @foreach ($data as $d)
            <table style="width: 75%">
                <tr>
                    <td style="width: 100%">
                        <table class="w-full table table-bordered">
                            <tr>
                                <td colspan="3" style="text-align: center">
                                    <p style="text-align: center; font-size: 16px; font-weight: 700;">
                                        PEMERINTAH KABUPATEN BANJAR <br>
                                        KECAMATAN MARTAPURA
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 20% !important">
                                    <img src="{{ asset('assets/img/banjar.png') }}" style="width: 80px;" alt="">
                                </td>
                                <td style="text-align: center;width: 20% !important">
                                    <img
                                        src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate(route('inventaris-detail', md5($d->id)))) }} ">
                                </td>
                                <td style="width: auto !important; padding: 0 2px">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>No. BPKB</td>
                                            <td>:</td>
                                            <td>
                                                {{ $d->no_bpkb }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Polisi</td>
                                            <td>:</td>
                                            <td>
                                                {{ $d->no_polisi }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Rangka</td>
                                            <td>:</td>
                                            <td>
                                                {{ $d->no_rangka }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Mesin</td>
                                            <td>:</td>
                                            <td>
                                                {{ $d->no_mesin }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pegawai</td>
                                            <td>:</td>
                                            <td>
                                                {{ $d->pegawai ? $d->pegawai->nama_pegawai : '-' }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p style="text-align: center; font-weight: 700">
                                        {{ $d->kode }} - {{ $d->register }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding: 4px 0px">
                                    <p style="text-align: center; font-style: italic; font-size: 12px">
                                        <span>*</span> Scan QR untuk mengetahui detail barang
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        @endforeach



    </div>

</body>
