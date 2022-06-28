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
                <td class="text-center">BERITA ACARA PEMERIKSAAN BARANG</td>
            </tr>
            <tr>
                <td class="text-center">No. {{ $pemeriksaanBarang->no_pemeriksaan }} /
                    {{ Carbon\Carbon::parse(Carbon\Carbon::now())->isoFormat('Y') }} </td>
            </tr>
        </table>

        <table class="w-full" style="margin: 20px 0">
            <tr>
                <td>Pada hari ini
                    {{ Carbon\Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('dddd') }}
                    tanggal {{ $terbilang['tgl'] }}
                    Bulan {{ Carbon\Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('MMMM') }}
                    Tahun {{ $terbilang['tahun'] }}
                    kami yang bertanda
                    tangan di bawah ini:
                </td>
            </tr>
        </table>

        <table class="w-full table table-bordered" style="margin: 20px 0">
            <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Nama</th>
                    <th style="width: 90px">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td> {{ $pemeriksaanBarang->pemeriksa_1 }} </td>
                    <td class="text-center">Ketua Tim</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td> {{ $pemeriksaanBarang->pemeriksa_2 }} </td>
                    <td class="text-center">Anggota</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td> {{ $pemeriksaanBarang->pemeriksa_3 }} </td>
                    <td class="text-center">Anggota</td>
                </tr>

            </tbody>
        </table>

        <table class="w-full" style="margin: 20px 0">
            <tr>
                <td>Telah memeriksa barang pembelian dari {{ $data->suplier->nama_suplier }}
                    pada tanggal {{ Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y') }}
                    berupa:</td>
            </tr>
        </table>

        <table class="w-full table table-bordered" style="margin: 20px 0">
            <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th style="width: auto">Nama Barang</th>
                    <th style="width: 20px" class="text-center">Byk</th>
                    <th style="width: 20px" class="text-center">Satuan</th>
                    <th style="width: 20px" class="text-center">Kondisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->detail_barang_masuk as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ App\Models\Barang::find($d->barang_id)->nama_barang }} </td>
                        <td class="text-center">{{ $d->jumlah_masuk }}</td>
                        <td class="text-center">Pcs</td>
                        <td class="text-center">Baik</td>
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

        <table class="w-full" style="margin: 5px 0">
            <tr>
                <td>Tim Pemeriksa Barang:</td>
            </tr>
        </table>

        <table class="w-full" style="margin: 5px 0">
            <tr>
                <td>Tanda Tangan</td>
            </tr>
        </table>

        <table class="w-full " style="margin: 10px 0">
            <tr>
                <td>1. {{ $pemeriksaanBarang->pemeriksa_1 }} </td>
                <td>1</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
            <tr>
                <td>2. {{ $pemeriksaanBarang->pemeriksa_2 }} </td>
                <td></td>
                <td>2</td>
            </tr>
            <tr>
                <td colspan="3"><br></td>
            </tr>
            <tr>
                <td>3. {{ $pemeriksaanBarang->pemeriksa_3 }} </td>
                <td>3</td>
                <td></td>
            </tr>
        </table>

    </div>

</body>
