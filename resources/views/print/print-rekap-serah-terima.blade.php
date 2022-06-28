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
                    <h2 style="text-align: center">Rekap Serah Terima Barang</h2>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="25%">Nomor Serah Terima</th>
                    <th width="25%">Tanggal</th>
                    <th width="25%">Ruangan</th>
                    <th width="25%">Penganggung Jawab Ruangan</th>
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
                        <td>{{ $d->no_serah_terima }}</td>
                        <td>
                            {{ Carbon\Carbon::parse($d->tanggal_serah_terima)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td>
                            {{ $d->ruangan->nama_ruangan }}
                        </td>
                        <td>
                            {{ App\Models\Pegawai::find($d->ruangan->pegawai_id)->nama_pegawai }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
