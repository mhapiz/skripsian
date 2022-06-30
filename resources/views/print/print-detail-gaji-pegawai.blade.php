<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    @include('modules.print.style')
</head>

<body>

    <div class="header ">
        <table class="w-full text-center" style=" height: 100px; padding-bottom: 10px; border-bottom: 1px solid black">

            <tr>
                <td style="width: 10%">
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 80px">
                </td>
                <td style="width: 30%">
                    <p style="text-align: start">
                        PEMERINTAH KABUPATEN BANJAR
                    </p>

                    <p style="font-size: 1.2rem; font-weight: bold; text-align: start">
                        KECAMATAN MARTAPURA
                    </p>
                    <p style="font-size: .8rem; text-align: start" class="fw-bold">
                        Jl.Sekumpul Ujung No.1 Bincau kode Pos 70651
                    </p>
                </td>
                <td>
                    <p style="font-size: 1.8rem; font-weight: bold; text-align: center">
                        Slip Gaji
                    </p>
                </td>
                <td style="width: 20%">
                    {{ Carbon\Carbon::parse()->isoFormat('D') }} /
                    {{ Carbon\Carbon::parse()->isoFormat('MM') }} /
                    {{ Carbon\Carbon::parse()->isoFormat('Y') }}
                </td>
            </tr>

        </table>
    </div>

    <div class="body" style="margin-top: 10px; ">

        <table class="w-full " style="font-size: 16px">
            <tr>
                <td class="va-top">
                    <table>
                        <tr>
                            <td style="padding-right: 1.5rem">Nama</td>
                            <td>:</td>
                            <td> {{ $data->pegawai->nama_pegawai }} </td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem;">Jabatan</td>
                            <td>:</td>
                            <td>{{ $data->pegawai->jabatan }}</td>
                        </tr>
                    </table>
                </td>
                <td class="va-top">
                    <table>
                        <tr>
                            <td style="padding-right: 1.5rem">Alamat</td>
                            <td>:</td>
                            <td>{{ $data->pegawai->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem;">Telepon</td>
                            <td>:</td>
                            <td>{{ $data->pegawai->no_hp }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="w-full">
            <thead style="border-bottom: 1px solid black;border-top: 1px solid black">
                <tr>
                    <th style="border: none; font-size: 1.1rem" width="5%">No.</th>
                    <th style="border: none; font-size: 1.1rem" width="">Keterangan</th>
                    <th style="border: none; font-size: 1.1rem" width="20%">Jumlah</th>
                </tr>
            </thead>

            <thead>
                <br>
                <tr>
                    <td style="text-align: center">1</td>
                    <td style="text-align: left; padding-left: 5rem">
                        Gaji Pokok
                    </td>
                    <td style="text-align: center">
                        Rp. {{ number_format($pangkat->gaji_pokok, 0, ',', '.') }}
                    </td>
                </tr>
                <br>
                <tr>
                    <td style="text-align: center">2</td>
                    <td style="text-align: left; padding-left: 5rem">
                        Potongan {{ $pangkat->potongan }}%
                    </td>
                    <td style="text-align: center">
                        {{ number_format(($pangkat->gaji_pokok * $pangkat->potongan) / 100, 0, ',', '.') }}
                    </td>
                </tr>
            </thead>

            <br>
            <tfoot style="border-top: 1px solid black; ">
                <br>

                <tr>
                    <td style="text-align: start" colspan="2" class="fw-bold">
                        {{ $data->gaji_terbilang }}
                    </td>

                    <td style="text-align: center">

                    </td>
                </tr>
                <br>

                <tr>
                    <td style="text-align: center;padding-bottom: 10px">

                    </td>

                    <td style="text-align: right; font-weight: bold;padding-bottom: 10px">
                        Total Diterima
                    </td>

                    <td style="text-align: center; border-bottom: 1px solid black; padding-bottom: 10px">
                        {{ 'Rp ' . number_format($data->total_gaji, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>

        </table>

        <br>

        <table class="w-full table " style="margin: 20px 0; font-size: .8rem">

            <tr>
                <td class="text-center">Penerima</td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Pejabat Pembuat Teknis Kebijakan</td>
            </tr>


            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>

            <tr>
                <td class="text-center fw-bold">
                    {{ $data->pegawai->nama_pegawai }}
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center fw-bold">
                    <u>M. Rusydi Ansharie </u>
                </td>
            </tr>

            <tr>
                <td class="text-center fw-bold">
                    NIP. {{ $data->pegawai->nip }}
                </td>
                <td style="width: 40% !important"></td>
                <td class="text-center fw-bold">
                    NIP. 19860804 200803 1 001
                </td>
            </tr>
        </table>


    </div>

</body>
