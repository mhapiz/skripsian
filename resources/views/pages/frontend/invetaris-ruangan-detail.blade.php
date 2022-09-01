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

    <title>Barang Inventaris Ruangan</title>
</head>

<body>
    <header class="bg-secondary py-4 d-flex">
        <img src="{{ asset('assets/img/banjar.png') }}" alt="logo" class="mx-auto" style="height: 4rem;">
    </header>

    <div class="container">
        <div class="row">
            <div class="col-12 m-4">
                <h1 class="h3 text-center">Barang Inventaris Ruangan</h1>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <tr>
                        <th width="350px">Nama Ruangan</th>
                        <td>{{ $data->nama_ruangan }}</td>
                    </tr>
                    <tr>
                        <th width="350px">Penanggung Jawab Ruangan</th>
                        <td>{{ $data->pegawai->nama_pegawai }}</td>
                    </tr>
                </table>
                <h4 class="text-center my-5">
                    Barang Inventaris
                </h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">No.</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Kode Barang + Register</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->inventaris as $inven)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ App\Models\Barang::find($inven->barang_id)->nama_barang }}
                                </td>
                                <td class="text-center">
                                    {{ App\Models\Barang::find($inven->barang_id)->kode_barang }}
                                    -
                                    {{ $inven->register }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
