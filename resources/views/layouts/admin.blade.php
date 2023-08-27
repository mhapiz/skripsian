<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Selamat datang di Situs Inventaris Kami! Temukan beragam informasi mengenai inventaris, stok barang, dan pengelolaan aset dengan efisien. Sistem kami membantu Anda mengelola inventaris secara terorganisir dan mudah.">
    <meta name="keywords" content="inventaris, stok barang, pengelolaan aset, manajemen inventaris, pencatatan barang">
    <meta name="author" content="mhpz">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('modules.backend.style')
    @livewireStyles
    @stack('tambahStyle')
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('modules.backend.navbar')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('modules.backend.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                @include('sweetalert::alert')
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2023</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('modules.backend.script')
    @livewireScripts
    @stack('tambahScript')

</body>

</html>
