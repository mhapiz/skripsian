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
                    <h2 style="text-align: center">Rekap Detail Laporan Barang Masuk</h2>
                </td>
            </tr>
        </table>

        <table class=" w-full">
            <tr>
                <td class="va-top">

                    <table>
                        <tr>
                            <td style="padding-right: 1.5rem">Tahun</td>
                            <td>:</td>
                            <td>{{ $tahun }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="20px">No.</th>
                    <th>Tahun</th>
                    <th>Bulan</th>
                    <th width="300px">Total Belanja</th>
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
                    @php
                        switch ($value->month) {
                            case '1':
                                $bulan = 'Januari';
                                break;
                            case '2':
                                $bulan = 'Februari';
                                break;
                            case '3':
                                $bulan = 'Maret';
                                break;
                            case '4':
                                $bulan = 'April';
                                break;
                            case '5':
                                $bulan = 'Mei';
                                break;
                            case '6':
                                $bulan = 'Juni';
                                break;
                            case '7':
                                $bulan = 'Juli';
                                break;
                            case '8':
                                $bulan = 'Agustus';
                                break;
                            case '9':
                                $bulan = 'September';
                                break;
                            case '10':
                                $bulan = 'Oktober';
                                break;
                            case '11':
                                $bulan = 'November';
                                break;
                            case '12':
                                $bulan = 'Desember';
                                break;

                            default:
                                $bulan = $row->month;
                                break;
                        }
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $value->year }}
                        </td>
                        <td>
                            {{ $bulan }}
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($value->total_belanja, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
