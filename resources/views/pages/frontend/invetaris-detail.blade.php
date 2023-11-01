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
        <div class="row d-flex justify-content-center">
            <div class="col-12 m-4">
                <h1 class="h3 text-center">Pemerintah Kabupaten Banjar <br> Kecamatan Martapura <br> </h1>
            </div>
            <div class="col-12 col-lg-4">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" class="text-center">
                            <span class="h5">Barang Milik Daerah</span>
                        </td>
                    </tr>
                    <tr>
                        <th width="200px">Nama Aset</th>
                        <td>{{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <th>Kode Aset</th>
                        <td>{{ $data->kode }}</td>
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
                        <th>Foto Barang</th>
                        <td>
                            <img src="{{ asset('storage/barang/' . $data->foto_path) }}" alt="foto{{ $data->nama }}"
                                width="200px">
                        </td>
                    </tr>
                    @if ($data->jenis === 'kendaraanDinas')
                        <tr>
                            <th>Nomor BPKB</i></th>
                            <td>{{ $data->no_bpkb }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Polisi</i></th>
                            <td>{{ $data->no_polisi }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Rangka</i></th>
                            <td>{{ $data->no_rangka }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Mesin</i></th>
                            <td>{{ $data->no_mesin }}</td>
                        </tr>
                    @endif

                    <tr>
                        <th>Jenis Kepemilikan</th>
                        <td>
                            {{ $data->jenis_kepemilikan ? ucwords($data->jenis_kepemilikan) : 'Bebas' }}
                        </td>
                    </tr>

                    @if ($data->jenis_kepemilikan === 'ruangan')
                        <tr>
                            <th>Ruangan</th>
                            <td>
                                {{ $data->ruangan->nama_ruangan }}
                            </td>
                        </tr>
                        <tr>
                            <th>Penanggung Jawab Ruangan</th>
                            <td>
                                {{ $data->ruangan->pegawai ? $data->ruangan->pegawai->nama_pegawai : '-' }}
                            </td>
                        </tr>
                    @elseif($data->jenis_kepemilikan === 'pegawai')
                        <tr>
                            <th>Nama Pegawai</th>
                            <td>
                                {{ $data->pegawai ? $data->pegawai->nama_pegawai : '-' }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
