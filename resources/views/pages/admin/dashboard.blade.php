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
                    {{-- <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Mutasi Barang</h5>
                                <span>Klik <a href="{{ route('admin.mutasi.index') }}">disini</a> untuk memutasi
                                    barang</span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{ $totalAset }} </h4>
                                <h6>Total Barang Inventaris</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

{{-- @push('tambahStyle')
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
@endpush --}}
