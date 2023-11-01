<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')

</head>

<body>
    <div class="header">
        <table class="w-full text-center" style=" height: 100px; padding-bottom: 10px">
            <tr>
                <td>
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 80px">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: center; margin-top: 1rem">
                        PEMERINTAH KABUPATEN BANJAR
                    </p>
                    <p style="text-align: center">
                        KECAMATAN MARTAPURA
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: center; margin-top: 2rem">
                        PAKTA INTEGRITAS PENGGUNA BARANG MILIK DAERAH
                    </p>
                </td>
            </tr>
        </table>
    </div>


    <div class="body" style="margin-top: 10px; ">
        <table class="w-full table table-pad" style="font-size: .8rem; text-align: start">
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px">Nama</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->nama_pegawai }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px">NIP</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->nip }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px">Jabatan</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->jabatan }}</td>
            </tr>
            <tr>
                <td style="padding-top: 8px; padding-bottom: 8px">Alamat</th>
                <td style="padding-top: 8px; padding-bottom: 8px">: &nbsp;&nbsp; {{ $pihakPertama->alamat }}</td>
            </tr>
        </table>

        <table class="w-full table table-pad" style="font-size: .8rem; text-align: start">
            <tr>
                <td colspan="2">
                    <p>Menyatakan Sebagai Berikut:</p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 1.</td>
                <td>
                    <p>
                        Bersedia menggunakan fasilitas barang milik daerah semata-mata hanya untuk kepentingan dan keperluan dinas,
                        tidak untuk kepentingan pribadi (termasuk keluarga, teman, dll);
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 2.</td>
                <td>
                    <p>
                        Tidak mempergunakan, mengoperasikan dan meminjamkan barang milik daerah untuk keperluan lain selain keperluan dinas dan kepada pihak lain;
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 3.</td>
                <td>
                    <p>
                        Bersedia memelihara dan merawat barang milik daerah dimaksud agar selalu dalam keadaan baik dan siap pakai dan saya
                        tidak akan menuntuk ganti rugi apapun ataupun biaya pengganti atas segala biaya yang telah saya keluarkan berkaitan
                        dengan pemeliharaan dan perawatan barang milik daerah dimaksud, selain biaya yang dikeluarkan dinas;
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 4.</td>
                <td>
                    <p>
                        Bersedia menyerahkan/mengembalikan kepada SKPD melalui Sekretaris yang membidangi masalah perlengkapan dan
                        aset, apabila terjadi mutasi keluar dari SKPD atau pensiun;
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 5.</td>
                <td>
                    <p>
                        Bersedia bertanggung jawab atas kejadian yang menimpa barang milik daerah dimaksud berupa kehilangan, kerusakan dan
                        atau akibat kecelakaan sesuai dengan ketentuan aturan berlaku, diluar keperluan dinas;
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">&nbsp;&nbsp;&nbsp;&nbsp; 6.</td>
                <td>
                    <p>
                        Apabila saya dalam penggunaan fasilitas barang milik daerah dimaksud tidak mentaati penggunaan barang milik daerah, maka bersedia diproses sesuai peraturan;
                    </p>
                </td>
            </tr>
        </table>

        <table class="w-full table" style="font-size: .8rem">
            <tr>
                <td class="text-center"></td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Martapura, &nbsp;&nbsp; {{ \Carbon\Carbon::now()->isoFormat('MMMM Y'); }}</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Yang Membuat Pernyataan</td>
            </tr>
            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center">
                    <u>{{ $pihakKedua->nama_pegawai }} </u>
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    <u>{{ $pihakPertama->nama_pegawai }} </u>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    NIP. {{ $pihakKedua->nip }}
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    NIP. {{ $pihakPertama->nip }}
                </td>
            </tr>
        </table>

        <table class="w-full table" style="font-size: .8rem">
            <tr>
                <td class="text-center" style="width: 35% !important"></td>
                <td style="width: auto !important">Mengetahui</td>
                <td class="text-center" style="width: 35% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 35% !important"></td>
                <td style="width: auto !important">{{ $camat->jabatan ?? '-' }}</td>
                <td class="text-center" style="width: 35% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 35% !important"> <br><br><br><br> </td>
                <td style="width: auto !important"> <br><br><br><br> </td>
                <td class="text-center" style="width: 35% !important"> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center" style="width: 35% !important"></td>
                <td style="width: auto !important">
                    <u>{{ $camat->nama_pegawai ?? '-' }}</u>
                </td>
                <td class="text-center" style="width: 35% !important"></td>
            </tr>
            <tr>
                <td class="text-center" style="width: 35% !important"></td>
                <td style="width: auto !important">
                    NIP. {{ $camat->nip ?? '-' }}
                </td>
                <td class="text-center" style="width: 35% !important"></td>
            </tr>
        </table>

    </div>

    <div class="page-break"></div>

    <div class="body" style="margin-top: 10px; ">
        <table class="w-full " style="font-size: .7rem">
            <tr>
                <td class="text-center">Daftar Barang Yang Digunakan/Dimanfaatkan</td>
            </tr>
        </table>

        <table class="table w-full table-bordered" style="font-size: .7rem">
            <thead>
                <tr>
                    <td rowspan="2" style="width: 1%">No.</td>
                    <td rowspan="2" style="width: 14%">Nama Barang</td>
                    <td colspan="7" style="text-align: center">Dokumen Barang</td>
                </tr>
                <tr>
                    <td style="width: 10% !important">Tahun Pengadaan</td>
                    <td>Jenis</td>
                    <td>Merk/Type</td>
                    <td style="width: 80px !important">No. Polisi</td>
                    <td>No. Rangka</td>
                    <td>No. Mesin</td>
                    <td>Keterangan</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($aset as $as)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $as->nama }}</td>
                        <td>{{ $as->tahun_masuk }}</td>
                        <td>{{ $as->jenis }}</td>
                        <td>{{ $as->merk }}</td>
                        <td>{{ $as->no_polisi ?? '-' }}</td>
                        <td>{{ $as->no_rangka ?? '-' }}</td>
                        <td>{{ $as->no_mesin ?? '-' }}</td>
                        <td>{{ $as->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="w-full table" style="font-size: .8rem; margin-top: 10px">
            <tr>
                <td class="text-center"></td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Martapura, &nbsp;&nbsp; {{ \Carbon\Carbon::now()->isoFormat('MMMM Y'); }}</td>
            </tr>
            <tr>
                <td class="text-center"></td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Yang Membuat Pernyataan</td>
            </tr>
            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>
            <tr>
                <td class="text-center">
                    <u>{{ $pihakKedua->nama_pegawai }} </u>
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    <u>{{ $pihakPertama->nama_pegawai }} </u>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    NIP. {{ $pihakKedua->nip }}
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center">
                    NIP. {{ $pihakPertama->nip }}
                </td>
            </tr>
        </table>
    </div>

</body>
