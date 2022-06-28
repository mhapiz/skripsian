<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')
</head>

<body>
    @include('modules.print.kop')

    <div class="body" style="margin-top: 10px; ">

        <table class="w-full">
            <tr>
                <td>
                    <h2 style="text-align: center">Detail Barang Masuk</h2>
                </td>
            </tr>
        </table>

        <table class=" w-full">
            <tr>
                <td class="va-top">

                    <table>
                        {{-- <tr>
                            <td style="padding-right: 1.5rem">Nomor</td>
                            <td>:</td>
                            <td>01/ /KEC.MTP
                            </td>
                        </tr> --}}
                        <tr>
                            <td style="padding-right: 1.5rem">Tanggal</td>
                            <td>:</td>
                            <td> {{ Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, D MMMM Y') }} </td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem">Suplier</td>
                            <td>:</td>
                            <td> {{ $data->suplier->nama_suplier }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="25%">Nama Barang</th>
                    <th width="25%">Kode Barang</th>
                    <th>Banyaknya</th>
                    <th>Harga Satuan <br> (RP)</th>
                    <th>Jumlah <br> (RP)</th>
                </tr>
                <tr style="font-size: .8rem;">
                    <td style="padding: 2px">1</td>
                    <td style="padding: 2px">2</td>
                    <td style="padding: 2px">3</td>
                    <td style="padding: 2px">4</td>
                    <td style="padding: 2px">5</td>
                    <td style="padding: 2px">6</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($data->detail_barang_masuk as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ App\Models\Barang::find($value->barang_id)->nama_barang }}
                        </td>
                        <td>
                            {{ App\Models\Barang::find($value->barang_id)->kode_barang }}
                        </td>
                        <td>
                            {{ $value->jumlah_masuk }}
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($value->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($value->harga_satuan * $value->jumlah_masuk, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
