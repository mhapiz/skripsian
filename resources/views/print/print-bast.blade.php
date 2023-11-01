<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')

</head>

<body>
    @include('modules.print.kop')

    <div class="body" style="margin-top: 10px; ">

        <table class="w-full" style="font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center fw-bold">
                        BERITA ACARA SERAH TERIMA <br>
                        KENDARAAN DINAS JABATAN
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-center">No. 39749/
                    {{ Carbon\Carbon::parse(Carbon\Carbon::now())->isoFormat('Y') }} </td>
            </tr>
            <tr>
                <td class="text-center">Tanggal : </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem;">
            <tr>
                <td>Pada hari ini
                    tangan di bawah ini:
                </td>
            </tr>
        </table>

        <table class="w-full table table-pad" style="margin: 10px 0;font-size: .8rem; text-align: start">
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 10px !important; vertical-align: top !important"
                    rowspan="3">1.</th>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">Nama</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->nama_pegawai }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">NIP</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->nip }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">Jabatan</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->jabatan }}</td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>Selanjutnya disebut <span class="fw-bold">PIHAK PERTAMA</span> </td>
            </tr>
        </table>

        <table class="w-full table table-pad" style="margin: 10px 0;font-size: .8rem; text-align: start">
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 10px !important; vertical-align: top !important"
                    rowspan="3">2.</th>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">Nama</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakKedua->nama_pegawai }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">NIP</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakKedua->nip }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px; width: 60px !important">Jabatan</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakKedua->jabatan }}</td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>Selanjutnya disebut <span class="fw-bold">PIHAK KEDUA</span> </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p>
                        Dengan ini PIHAK PERTAMA telah melakukan serah terima barang milik daerah berupa {{ $jenis }} kepada PIHAK KEDUA dengan rincian sebagai berikut .</p>
                </td>
            </tr>
        </table>

        <table class="table table-bordered w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td style="width: 120px">Merk</td>
                <td style="width: 5px">:</td>
                <td style="width: auto">{{ $aset->merk }}</td>
            </tr>
            <tr>
                <td>Nama Aset</td>
                <td>:</td>
                <td>{{ $aset->nama }}</td>
            </tr>
            <tr>
                <td>Tahun Perolehan</td>
                <td>:</td>
                <td>{{ $aset->tahun_masuk }}</td>
            </tr>
            <tr>
                <td>Jangka Waktu</td>
                <td>:</td>
                <td>Sampai Selesai Masa Jabatan</td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td>{{ $aset->kode }}</td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p>Berita acara serah terima {{ $jenis }} ini dibuat sesuai dengan yang diatur dalam
                            Peraturan Menteri Dalam Negeri nomor 19 tahun 2016 tentang Pedoman Pengelolaan Barang Milik
                            Daerah Bab VIII pengamanan dan pemeliharaan, pasal 303 s/d pasal 307, dengan memuat klausa
                            yang mengikat antara lain:</p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center" style="margin-bottom: 8px">Pasal 1</p>
                    <p>
                        PIHAK KEDUA sebagai penanggung jawab {{ $jenis }} menyatakan bertanggung jawab atas
                            kendaraan dengan keterangan antara lain: nomor polisi, merek, tahun perakitan kendaraan,
                            kode barang, dan rincian perlengkapan yang melekat pada kendaraan sebagaimana tersebut diatas
                            dalam berita acara serah terima ini;
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center" style="margin-bottom: 8px">Pasal 2</p>
                    <p>PIHAK KEDUA sebagai penanggung jawab {{ $jenis }} menyatakan tanggung jawab atas
                        {{ $jenis }} dengan seluruh risiko yang melekat atas {{ $jenis }} tersebut
                        diatas dalam berita acara serah terima kendaraan dinas jabatan ini;
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center" style="margin-bottom: 8px">Pasal 3</p>
                    <p>PIHAK KEDUA sebagai penanggung jawab {{ $jenis }} menyatakan akan mengembalikan
                        {{ $jenis }} tersebut diatas dalam berita acara serah terima {{ $jenis }} ini setelah
                        ........................ atau pada masa jabatan PIHAK KEDUA telah berakhir, mutasi ke berakhirnya
                        jangka waktu penggunaan pada tanggal
                        OPD lain atau mutasi keluar daerah;
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center" style="margin-bottom: 8px">Pasal 4</p>
                    <p>
                        PIHAK KEDUA sebagai penanggung jawab akan mengembalikan {{ $jenis }}
                        dan diserahkan pada PIHAK PERTAMA saat berakhirnya masa jabatan sesuai yang
                        tertera dalam berita acara serah terima kendaraan dinas jabatan ini;
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p class="text-center" style="margin-bottom: 8px">Pasal 5</p>
                    <p>
                        Kehilangan {{ $jenis }} sesuai yang tertera dalam berita acara serah terima {{ $jenis }}
                        ini menjadi tanggung jawab PIHAK KEDUA sebagai penanggung jawab
                        {{ $jenis }} dengan sanksi sesuai ketentuan peraturan perundang - undangan.
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 10px 0;font-size: .8rem">
            <tr>
                <td>
                    <p>
                        Demikian berita acara serah terima {{ $jenis }} ini dibuat agar {{ $jenis }}
                        yang disediakan dipergunakan pejabat untuk menunjang kegiatan operasional
                        perkantoran dengan sebaik-baiknya.
                        Pihak-pihak yang melakukan serah terima
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full table" style="font-size: .8rem">
            <tr>
                <td class="text-center">
                    <span class="fw-bold">PIHAK KEDUA</span>
                </td>
                <td style="width: 30% !important"></td>
                <td class="text-center">
                    <span class="fw-bold">PIHAK PERTAMA</span>
                </td>
            </tr>
            <tr>
                <td class="text-center">{{ $pihakKedua->jabatan }}</td>
                <td style="width: 30% !important"></td>
                <td class="text-center">{{ $pihakPertama->jabatan }}</td>
            </tr>
            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 30% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center">
                    <u>{{ $pihakKedua->nama_pegawai }}</u>
                </td>
                <td style="width: 30% !important"></td>
                <td class="text-center">
                    <u>{{ $pihakPertama->nama_pegawai }} </u>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    NIP. {{ $pihakKedua->nip }}
                </td>
                <td style="width: 30% !important"></td>
                <td class="text-center">
                    NIP. {{ $pihakPertama->nip }}
                </td>
            </tr>
        </table>

        <table class="w-full table" style="margin-top: 3rem;font-size: .8rem">
            <tr>
                <td class="text-center" style="width: 20% !important"></td>
                <td style="width: auto !important" class="text-center">Mengetahui</td>
                <td class="text-center" style="width: 20% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 20% !important"></td>
                <td style="width: auto !important" class="text-center">{{ $camat->jabatan ?? '-' }}
                </td>
                <td class="text-center" style="width: 20% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 20% !important"> <br><br><br><br> </td>
                <td style="width: auto !important" class="text-center"> <br><br><br><br> </td>
                <td class="text-center" style="width: 20% !important"> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center" style="width: 20% !important"></td>
                <td style="width: auto !important" class="text-center">
                    <u>{{ $camat->nama_pegawai ?? '-' }}</u>
                </td>
                <td class="text-center" style="width: 20% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 20% !important"></td>
                <td style="width: auto !important" class="text-center">
                    NIP. {{ $camat->nip ?? '-' }}
                </td>
                <td class="text-center" style="width: 20% !important"></td>
            </tr>
        </table>

    </div>

</body>
