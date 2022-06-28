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
                    <h2 style="text-align: center">Detail Aset Masuk</h2>
                </td>
            </tr>
        </table>

        <table class=" w-full">
            <tr>
                <td class="va-top">

                    <table>
                        <tr>
                            <td style="padding-right: 1.5rem">Nomor</td>
                            <td>:</td>
                            <td>{{ $data->nomor }} / KEC.MTP
                            </td>
                        </tr>
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
                    <th width="25%">Nama Aset</th>
                    <th width="25%">Kode Aset</th>
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
                @foreach ($data->detail_aset_masuk as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $value->nama_aset }}
                        </td>
                        <td>
                            {{ $value->kode_aset }}
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
                <tr>
                    <td colspan="5" class="text-center fw-bold">Total</td>
                    <td>
                        {{ 'Rp ' . number_format($data->total_harga, 2, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
