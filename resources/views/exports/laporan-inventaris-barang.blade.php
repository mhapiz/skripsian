<table>
    <thead>
        <tr>
            <th style="font-weight: 700" rowspan="2">No.</th>
            <th style="font-weight: 700" rowspan="2">Jenis Barang / Nama Barang</th>
            <th style="font-weight: 700" rowspan="2">Merk / Model</th>
            <th style="font-weight: 700" rowspan="2">Tahun Pembuatan / Pembelian</th>
            <th style="font-weight: 700" rowspan="2">No. Kode Barang</th>
            <th style="font-weight: 700" rowspan="2">Jumlah Barang / Register</th>
            <th style="font-weight: 700" rowspan="2">Harga Beli / Perolehan</th>
            <th style="font-weight: 700" colspan="3">Keadaan Barang</th>
            <th style="font-weight: 700" rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th style="font-weight: 700">Baik</th>
            <th style="font-weight: 700">Kurang Baik</th>
            <th style="font-weight: 700">Rusak Berat</th>
        </tr>
        <tr>
            <th style="font-weight: 700">1</th>
            <th style="font-weight: 700">2</th>
            <th style="font-weight: 700">3</th>
            <th style="font-weight: 700">4</th>
            <th style="font-weight: 700">5</th>
            <th style="font-weight: 700">6</th>
            <th style="font-weight: 700">7</th>
            <th style="font-weight: 700">8</th>
            <th style="font-weight: 700">9</th>
            <th style="font-weight: 700">10</th>
            <th style="font-weight: 700">11</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $d['nama'] }}
            </td>
            <td>
                {{ $d['merk'] }}
            </td>
            <td>{{ $d['tahun_masuk'] }}</td>
            <td>{{ $d['kode'] }}</td>
            <td>{{ $d['total_barang'] }}</td>
            <td>{{ $d['harga'] }}</td>
            <td>{{ $d['kondisi']['baik'] }}</td>
            <td>{{ $d['kondisi']['cukup_baik'] }}</td>
            <td>{{ $d['kondisi']['rusak_berat'] }}</td>
            <td>
                {{ $d['keterangan'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
