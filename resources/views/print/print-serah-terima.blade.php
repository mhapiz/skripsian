<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')

</head>

<body>
    @include('modules.print.kop')

    <div class="body" style="margin-top: 10px; ">

        <table class="w-full ">
            <tr>
                <td class="text-center">
                    <u>BERITA ACARA SERAH TERIMA BARANG</u>
                </td>
            </tr>
            <tr>
                <td class="text-center">No. {{ $data['no_serah_terima'] }} /
                    {{ Carbon\Carbon::parse($data['tanggal_serah_terima'])->isoFormat('Y') }} </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 20px 0">
            <tr>
                <td>Pada hari ini {{ Carbon\Carbon::parse($data['tanggal_serah_terima'])->isoFormat('dddd') }} tanggal
                    {{ $terbilang['tgl'] }}
                    {{ Carbon\Carbon::parse($data['tanggal_serah_terima'])->isoFormat('MMMM') }} Tahun
                    {{ $terbilang['tahun'] }}
                    kami yang
                    bertanda
                    tangan di bawah ini:</td>
            </tr>
        </table>


        <table class="w-full table table-pad" style="margin: 20px 0">
            <tr>
                <td rowspan="5" style="text-align: center; vertical-align: top; width: 10px">I.</td>
                <td>Nama </td>
                <td>: M. Rusydi Ansharie </td>
            </tr>
            <tr>
                <td>NIP </td>
                <td>: 19860804 200803 1 001</td>
            </tr>
            <tr>
                <td>Jabatan </td>
                <td>: Pegawai Pembuat Teknis Kebijakan</td>
            </tr>
            <tr>
                <td colspan="2">Selanjutnya disebut sebagai <span class="fw-bold">PIHAK PERTAMA</span></td>
            </tr>
        </table>


        <table class="w-full table table-pad" style="margin: 20px 0">
            <tr>
                <td rowspan="5" style="text-align: center; vertical-align: top; width: 10px">II.</td>
                <td>Nama </td>
                <td>: {{ $kepala_ruangan->nama_pegawai }}</td>
            </tr>
            <tr>
                <td>NIP </td>
                <td>: {{ $kepala_ruangan->nip }}</td>
            </tr>
            <tr>
                <td>Jabatan </td>
                <td>: {{ $kepala_ruangan->jabatan }}</td>
            </tr>
            <tr>
                <td colspan="2">Selanjutnya disebut sebagai <span class="fw-bold">PIHAK KEDUA</span></td>
            </tr>
        </table>

        <table class="w-full" style="margin: 20px 0">
            <tr>
                <td>Selanjutnya tanggung jawab terhadap Penggunaan dan pencatatan barang diserahkan kepada
                    {{ $data->ruangan->nama_ruangan }}</td>
            </tr>
        </table>

        <table class="w-full" style="margin-top: 10px">
            <tr>
                <td>PIHAK PERTAMA menyerahkan barang kepada PIHAK KEDUA sebagai berikut:</td>
            </tr>
        </table>

        <table class="w-full table table-bordered" style="margin-top: 10px">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->detail as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ App\Models\Barang::find($d->barang_id)->nama_barang }}</td>
                        <td>{{ $d->jumlah }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>


        <table class="w-full" style="margin: 20px 0">
            <tr>
                <td>Demikian berita acara pemeriksaan barang ini dibuat dengan sebenarnya agar dapat digunakan
                    sebagaimana mestinya.</td>
            </tr>

        </table>

        <table class="w-full table " style="margin: 20px 0; font-size: .8rem">
            <tr>
                <td></td>
                <td style="width: 40% !important"></td>
                <td>Martapura, {{ Carbon\Carbon::parse($data['tanggal_serah_terima'])->isoFormat('D MMMM Y') }}</td>
            </tr>

            <tr>
                <td>Yang Menerima</td>
                <td style="width: 40% !important"></td>
                <td>Yang Menyerahkan</td>
            </tr>

            <tr>
                <td>PIHAK KEDUA</td>
                <td style="width: 40% !important"></td>
                <td>PIHAK PERTAMA</td>
            </tr>

            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>

            <tr>
                <td>{{ $kepala_ruangan['nama_pegawai'] }}</td>
                <td style="width: 40% !important"></td>
                <td>M. Rusydi Ansharie </td>
            </tr>

            <tr>
                <td>NIP {{ $kepala_ruangan['nip'] }}</td>
                <td style="width: 40% !important"></td>
                <td>NIP 19860804 200803 1 001</td>
            </tr>
        </table>

        <table class="w-full table text-center" style="margin: 20px 0; font-size: .8rem">
            <tr>
                <td style="width: 30% !important"></td>
                <td>Mengetahui</td>
                <td style="width: 30% !important"></td>
            </tr>
            <tr>
                <td style="width: 30% !important"></td>
                <td>Camat Martapura,</td>
                <td style="width: 30% !important"></td>
            </tr>
            <tr>
                <td style="width: 30% !important"></td>
                <td> <br><br><br><br> </td>
                <td style="width: 30% !important"></td>
            </tr>
            <tr>
                <td style="width: 30% !important"></td>
                <td>MUHAMMAD RAMLI, S.IP, M. AP</td>
                <td style="width: 30% !important"></td>
            </tr>
            <tr>
                <td style="width: 30% !important"></td>
                <td>NIP 19740520 199403 1 001</td>
                <td style="width: 30% !important"></td>
            </tr>
        </table>


    </div>

</body>
