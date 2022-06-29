<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('assets/img/banjar.png') }}" type="image/x-icon">

    <title>Detail</title>
</head>

<body>
    <header class="bg-secondary py-4 d-flex">
        <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" class="mx-auto" style="height: 4rem;">
    </header>

    <div class="container">
        <div class="row">
            <div class="col-12 m-4">
                <h1 class="h3 text-center">Detail Barang Inventaris</h1>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <th width="200px">Nama Barang</th>
                        <td>{{ $data->barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ $data->barang->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Register</i></th>
                        <td>{{ $data->register }}</td>
                    </tr>
                    <tr>
                        <th>Kondisi</i></th>
                        <td>{{ $data->kondisi }} </td>
                    </tr>
                    <tr>
                        <th>QR Code</i></th>
                        <td>{{ QrCode::size(200)->generate(route('admin.inventaris.detail', md5($data->id_inventaris))) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Foto Barang</th>
                        <td>
                            <img src="{{ asset('storage/barang/' . $data->barang->foto_path) }}"
                                alt="foto{{ $data->barang->nama_barang }}" width="200px">
                        </td>
                    </tr>
                    <tr>
                        <th>Ruangan</i></th>
                        <td>
                            @if ($data->ruangan)
                                {{ $data->ruangan->nama_ruangan }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
