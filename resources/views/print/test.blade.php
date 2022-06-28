<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>print</title>
    <style>
        body {
            margin: 5px 20px;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

        .w-full {
            width: 100%;
        }

        p {
            margin: 0
        }

        .page-break {
            page-break-after: always;
        }

        .va-top {
            vertical-align: top
        }

        .fw-bold {
            font-weight: 700;
        }

        .text-center {
            text-align: center
        }

        .table-special {
            border-collapse: collapse;
            border: 1px solid black;
            width: 100%;
        }

        .table-special td {
            border-right: 1px solid black;
            padding: 2px 12px;

        }

        .table {
            border-collapse: collapse
        }

        .table-bordered td,
        th {
            border: 1px solid black;
            padding: 8px 12px;
        }



        .table-pad td,
        th {
            padding: 5px 12px;
        }

        p {
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="w-full text-center" style=" height: 100px; border-bottom: 1px double black; padding-bottom: 10px">
            <tr>
                <td style="width: 10%">
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 80px">
                </td>
                <td style="width: auto; text-align: center !important;font-size: 1.5rem;padding-left: 20px ">
                    <p>
                        PEMERINTAH KABUPATEN BANJAR
                    </p>

                    <p style="font-size: 2.1rem; font-weight: bold">
                        KECAMATAN MARTAPURA
                    </p>
                    <p style="font-size: 1.1rem" class="fw-bold">
                        Jl.Sekumpul Ujung No.1 Bincau kode Pos 70651
                    </p>
                </td>
                <td style="width: 10%">
                    <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" style="height: 80px; opacity: 0">
                </td>
            </tr>

        </table>
    </div>

    <div class="body" style="margin-top: 10px; ">

        <table class=" w-full">
            <tr>
                <td class="va-top">

                    <table>
                        <tr>
                            <td style="padding-right: 1.5rem">Nomor</td>
                            <td>:</td>
                            <td>01/ /KEC.MTP

                            </td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem">Lampiran</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="padding-right: 1.5rem">Perihal</td>
                            <td>:</td>
                            <td> Pesanan Barang / Order</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br> <br>

        <table class="table table-bordered w-full text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="40%">Nama Barang</th>
                    <th>Banyaknya</th>
                    <th>Harga Satuan <br> (RP)</th>
                    <th>Jumlah <br> (RP)</th>
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
                <tr>
                    <td>1</td>
                    <td>Nama Barang</td>
                    <td>Banyak</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                </tr>

            </tbody>
        </table>

        <br>

        <table class="w-full">
            <tr>
                <td>
                    <p>
                        dengan ketentuan sebagai berikut :
                    </p>
                </td>
            </tr>

            <tr>
                <td>
                    <table>
                        <tr class=" va-top">
                            <td style="padding-right: 10px">1</td>
                            <td>
                                <p>
                                    Pembayaran akan dilakukan bila barang yang diorder sesuai dan dalam keadaan baik
                                    dan dinyatakan dengan Berita Acara Serah terima hasil pekerjaan.
                                </p>
                            </td>
                        </tr>
                        <tr class="va-top">
                            <td style=" padding-right: 10px">2</td>
                            <td>
                                <p>
                                    Pembayaran akan dibatalkan bila barang tidak sesuai dengan pesanan/order.
                                </p>
                            </td>
                        </tr>
                        <tr class="va-top">
                            <td style=" padding-right: 10px">3</td>
                            <td>
                                <p>
                                    Kwitansi harga atas barang tersebut di atas hanya dapat dibayarkan jika
                                    melampirkan Surat Pesanan/Order aslinya.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p>
                        Demikian disampaikan, atas kerjasamanya diucapkan terima kasih.
                    </p>
                </td>
            </tr>
        </table>

        <br>

        <table class="w-full table " style="margin: 20px 0; font-size: .8rem">

            <tr>
                <td></td>
                <td style="width: 40% !important"></td>
                <td class="text-center">Pejabat Pembuat Teknis Kebijakan</td>
            </tr>


            <tr>
                <td> <br><br><br><br> </td>
                <td style="width: 40% !important"> <br><br><br><br> </td>
                <td> <br><br><br><br> </td>
            </tr>

            <tr>
                <td></td>

                <td style="width: 40% !important"></td>
                <td class="text-center fw-bold">
                    <u>M. Rusydi Ansharie </u>
                </td>
            </tr>

            <tr>
                <td></td>
                <td style="width: 40% !important"></td>
                <td class="text-center fw-bold">
                    NIP. 19860804 200803 1 001
                </td>
            </tr>
        </table>

    </div>

</body>
