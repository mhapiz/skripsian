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
                    <h2 style="text-align: center">Rekap Pemeriksaan Barang</h2>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="25%">Nomor Pemeriksaan</th>
                    <th width="25%">Tanggal</th>
                    <th width="25%">Pemeriksa</th>
                    <th width="25%">Total Harga</th>
                </tr>
                <tr style="font-size: .8rem;">
                    <td style="padding: 2px">1</td>
                    <td style="padding: 2px">2</td>
                    <td style="padding: 2px">3</td>
                    <td style="padding: 2px">4</td>
                    <td style="padding: 2px">5</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $key => $d)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $d->no_pemeriksaan }}</td>
                        <td>
                            {{ Carbon\Carbon::parse($d->tanggal_pemeriksaan)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td>
                            <span>{{ $d->pemeriksa_1 }}</span>,
                            <span>{{ $d->pemeriksa_2 }}</span>,
                            <span>{{ $d->pemeriksa_3 }}</span>
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($d->barangMasuk->total_harga, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
