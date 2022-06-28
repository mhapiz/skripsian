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
                    <h2 style="text-align: center">Rekap Gaji Pegawai</h2>
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
                    <th width="25%">Nama Pegawai</th>
                    <th width="25%">NIP</th>
                    <th width="25%">Bulan</th>
                    <th width="25%">Tahun</th>
                    <th width="25%">Gaji</th>
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
                @foreach ($data as $key => $value)
                    @php
                        switch ($value->bulan) {
                            case '01':
                                $bulan = 'Januari';
                                break;
                            case '02':
                                $bulan = 'Februari';
                                break;
                            case '03':
                                $bulan = 'Maret';
                                break;
                            case '04':
                                $bulan = 'April';
                                break;
                            case '05':
                                $bulan = 'Mei';
                                break;
                            case '06':
                                $bulan = 'Juni';
                                break;
                            case '07':
                                $bulan = 'Juli';
                                break;
                            case '08':
                                $bulan = 'Agustus';
                                break;
                            case '09':
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
                                $value->bulan;
                                break;
                        }
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $value->pegawai->nama_pegawai }}
                        </td>
                        <td>
                            {{ $value->pegawai->nip }}
                        </td>
                        <td>
                            {{ $bulan }}
                        </td>
                        <td>
                            {{ $value->tahun }}
                        </td>
                        <td>
                            {{ 'Rp ' . number_format($value->total_gaji, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
