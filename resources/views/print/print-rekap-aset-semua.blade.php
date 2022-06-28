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
                    <h2 style="text-align: center">Rekap Aset Tetap</h2>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Nama Aset</th>
                    <th>Kode Aset + No. Reg</th>
                    <th>Kondisi</th>
                    <th>Tahun</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $value->nama_aset }}
                        </td>
                        <td>
                            {{ $value->kode_aset }} - {{ $value->register }}
                        </td>
                        <td>
                            {{ $value->kondisi }}
                        </td>
                        <td>
                            {{ $value->tahun_masuk }}
                        </td>
                        <td>
                            {!! $value->keterangan !!}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
