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
                            <td style="padding-right: 1.5rem">Nama Ruangan</td>
                            <td>:</td>
                            <td>
                                {{ $data->nama_ruangan }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem">Penanggung Jawab Ruangan</td>
                            <td>:</td>
                            <td>
                                {{ $data->pegawai->nama_pegawai }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th width="50px">No.</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang + Register</th>
                </tr>
                <tr style="font-size: .8rem;">
                    <td style="padding: 2px">1</td>
                    <td style="padding: 2px">2</td>
                    <td style="padding: 2px">3</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($data->inventaris as $inven)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ App\Models\Barang::find($inven->barang_id)->nama_barang }}
                        </td>
                        <td>
                            {{ App\Models\Barang::find($inven->barang_id)->kode_barang }}
                            -
                            {{ $inven->register }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
