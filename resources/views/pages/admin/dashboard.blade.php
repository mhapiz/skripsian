@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        {{-- <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Mutasi Barang</h5>
                                <span>Klik <a href="{{ route('admin.mutasi.index') }}">disini</a> untuk memutasi
                                    barang</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{ $inven }} </h4>
                                <h6>Total Barang Inventaris</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{ $aset }} </h4>
                                <h6>Total Aset Tetap</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card earning-card">
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-xl-3 earning-content p-0">
                                <div class="row m-0 chart-left">
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>Dashboard</h5>
                                        <p class="font-roboto">Total Pengeluaran Tahun ini</p>
                                    </div>
                                    <div class="col-xl-12 p-0 left_side_earning">
                                        <h5>$4055.56 </h5>
                                        <p class="font-roboto">Pengeluaran Bulan Ini</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 p-0">
                                <div class="chart-right">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body p-0">
                                                <div class="current-sale-container" style="position: relative;">
                                                    <canvas id="line-chart" width="800" height="450"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tambahStyle')
@endpush

@push('tambahScript')
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let data = [
            @foreach ($bm as $item)
                {{ $item->total_belanja }},
            @endforeach
        ];

        console.log(data['Januari']);
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    data: data,
                    label: "Total Belanja Barang",
                    borderColor: "#3e95cd",
                    fill: true
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Belanja Barang'
                }
            }
        });
    </script>
@endpush
