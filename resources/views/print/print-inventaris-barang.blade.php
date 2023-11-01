<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')
</head>

<body>
    <div class="header">
        <table class="w-full text-center" style=" height: 100px; padding-bottom: 10px">
            <tr>
                <td style="width: 10%">
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 100px">
                </td>
                <td style="width: auto; text-align: center !important;padding-left: 20px ">
                    <p style="text-align: center">
                        PEMERINTAH KABUPATEN BANJAR
                    </p>
                    <p style="text-align: center">
                        KECAMATAN MARTAPURA
                    </p>

                    <p style="font-size: 1.2rem; font-weight: bold; text-align: center; margin-top: 1rem;">
                        LAPORAN INVENTARIS BARANG
                    </p>

                </td>
                <td style="width: 10%">
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 80px; opacity: 0">
                </td>
            </tr>

        </table>

        <table class="w-full table table-pad" style="font-size: .6rem; text-align: start">
            <tr>
                <td style="width: 180px; font-weight: 700;">Provinsi</th>
                <td style="width: 10px; font-weight: 700">:</th>
                <td style="width: auto" class="uppercase">Kalimantan Selatan</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Kab./Kota</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">Pemerintah Kabupaten Banjar</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Bidang</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">Sekretariat Daerah</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Unit Organisasi</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">Kecamatan Martapura</td>
            </tr>
            <tr>
                <td style="font-weight: 700">Sub Organisasi Organisasi</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">Kecamatan Martapura</td>
            </tr>
            <tr>
                <td style="font-weight: 700">U P B</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">Kecamatan Martapura</td>
            </tr>
            <tr>
                <td style="font-weight: 700">No. Kode Lokasi</th>
                <td style="font-weight: 700">:</th>
                <td class="uppercase">12.01.25.01.04.06.01.01.2004</td>
            </tr>
        </table>
    </div>


    <div class="body" style="margin-top: 10px; ">

        <table class="table table-bordered w-full text-center" style="font-size: .6rem">
            <thead>
                <tr>
                    <th rowspan="2" width="10px">No.</th>
                    <th rowspan="2">Jenis Barang / Nama Barang</th>
                    <th rowspan="2">Merk / Model</th>
                    <th rowspan="2">Tahun Pembuatan / Pembelian</th>
                    <th rowspan="2">No. Kode Barang</th>
                    <th rowspan="2">Jumlah Barang / Register</th>
                    <th rowspan="2">Harga Beli / Perolehan</th>
                    <th colspan="3">Keadaan Barang</th>
                    <th rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th>Baik</th>
                    <th>Kurang Baik</th>
                    <th>Rusak Berat</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th style="width: 16%">2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th style="width: 5%">8</th>
                    <th style="width: 5%">9</th>
                    <th style="width: 5%">10</th>
                    <th style="width: 8%">11</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{ $loop->iteration }}</th>
                    <td>
                        <p>{{ $d['nama'] }}</p>
                        </th>
                    <td>
                        <p>{{ $d['merk'] }}</p>
                        </th>
                    <td>{{ $d['tahun_masuk'] }}</th>
                    <td>{{ $d['kode'] }}</th>
                    <td>{{ $d['total_barang'] }}</th>
                    <td>{{ number_format($d['harga'],0,',','.') }}</th>
                    <td>{{ $d['kondisi']['baik'] }}</th>
                    <td>{{ $d['kondisi']['cukup_baik'] }}</th>
                    <td>{{ $d['kondisi']['rusak_berat'] }}</th>
                    <td>
                        <p>{{ $d['keterangan'] }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="w-full table" style="font-size: .6rem; margin-top: 10px">
            <tr>
                <td class="text-center">
                    <b>Mengetahui</b>
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    <b>Martapura, &nbsp;&nbsp; {{ \Carbon\Carbon::now()->isoFormat('MMMM Y'); }}</b>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <b>{{ $camat->jabatan ?? '-' }}</b>
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    <b>Pengurus Barang Pengguna
                        Kecamatan Martapura</b>
                </td>
            </tr>
            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center">
                    <u>{{ $camat->nama_pegawai ?? '-' }} </u>
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    <u>-</u>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    NIP. {{ $camat->nip ?? '-' }}
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    NIP. -
                </td>
            </tr>
        </table>

        <br>


    </div>

</body>
