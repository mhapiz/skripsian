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
                    <h2 style="text-align: center">Rekap Barang Inventaris</h2>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang + No. Reg</th>
                    <th>Kondisi</th>
                    <th>Ruangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $value->barang->nama_barang }}
                        </td>
                        <td>
                            {{ $value->barang->kode_barang }} - {{ $value->register }}
                        </td>
                        <td>
                            @if ($value->kondisi == 'baik')
                                Baik
                            @elseif ($value->kondisi == 'cukup_baik')
                                Cukup Baik
                            @elseif ($value->kondisi == 'rusak')
                                Rusak
                            @elseif ($value->kondisi == 'rusak_berat')
                                Rusak Berat
                            @endif
                        </td>
                        <td>
                            {{ $value->ruangan_id != null ? $value->ruangan->nama_ruangan : 'Belum Ditentukan' }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
