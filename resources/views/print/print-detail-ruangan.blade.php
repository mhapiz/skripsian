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
                    <h2 style="text-align: center">Detail Inventaris Ruangan</h2>
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
                                {{ $data->pegawai ? $data->pegawai->nama_pegawai : '' }}
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
                    <th>Kondisi</th>
                </tr>
                <tr style="font-size: .8rem;">
                    <td style="padding: 2px">1</td>
                    <td style="padding: 2px">2</td>
                    <td style="padding: 2px">3</td>
                    <td style="padding: 2px">4</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($data->aset as $aset)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $aset->nama }}
                        </td>
                        <td>
                            {{ $aset->kode }}
                            -
                            {{ $aset->register }}
                        </td>
                        <td>
                            @if ($aset->kondisi == 'baik')
                                Baik
                            @elseif ($aset->kondisi == 'cukup_baik')
                                Cukup Baik
                            @elseif ($aset->kondisi == 'rusak')
                                Rusak
                            @elseif ($aset->kondisi == 'rusak_berat')
                                Rusak Berat
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <br>

        @include('modules.print.ttd')

    </div>

</body>
