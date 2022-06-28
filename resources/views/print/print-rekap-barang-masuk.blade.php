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
                    <h2 style="text-align: center">Rekap Detail Barang Masuk</h2>
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
                            <td> {{ Carbon\Carbon::parse(Carbon\Carbon::now())->isoFormat('dddd, D MMMM Y') }} </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="25%">Tanggal</th>
                    <th>Suplier</th>
                    <th width="25%">Total Harga</th>
                </tr>
                <tr style="font-size: .8rem;">
                    <td style="padding: 2px">1</td>
                    <td style="padding: 2px">2</td>
                    <td style="padding: 2px">3</td>
                    <td style="padding: 2px">4</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ Carbon\Carbon::parse($value->tanggal)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td>
                            {{ $value->suplier->nama_suplier }}
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($value->total_harga, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
