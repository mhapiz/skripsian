<div class="sidebar-wrapper h-100">
    <nav class="sidebar-main">
        <div id="sidebar-menu">
            <ul class="sidebar-links custom-scrollbar">
                <li class="back-btn">
                    <a href="#">
                        <img class="img-fluid" src="#" alt="">
                    </a>
                    <div class="mobile-back text-right">
                        <span>Back</span>
                        <i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                    </div>
                </li>



                @if (Auth::user()->role == 'admin')
                    <li class="sidebar-main-title pt-0">
                        <div>
                            <h6>Halaman Admin</h6>
                            <p>Dashboard & Pengguna</p>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/pengguna') ? 'active' : '' }}"
                            href="{{ route('admin.pengguna.index') }}">
                            <i data-feather="users"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Master Data</h6>
                            <p>Pegawai, Ruangan, Aset</p>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/pegawai*') ? 'active' : '' }}"
                            href="{{ route('admin.pegawai.index') }}">
                            <i data-feather="hash"></i>
                            <span>Pegawai</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/ruangan*') ? 'active' : '' }}"
                            href="{{ route('admin.ruangan.index') }}">
                            <i data-feather="hash"></i>
                            <span>Ruangan</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/aset*') ? 'active' : '' }}"
                            href="{{ route('admin.aset.index') }}">
                            <i data-feather="hash"></i>
                            <span>Aset </span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/inventaris-ruangan*') ? 'active' : '' }}"
                            href="{{ route('admin.inventaris-ruangan.index') }}">
                            <i data-feather="hash"></i>
                            <span>Aset Ruangan</span>
                        </a>
                    </li>

                    {{--
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/gaji-pegawai*') ? 'active' : '' }}"
                        href="{{ route('admin.gaji-pegawai.index') }}">
                        <i data-feather="hash"></i>
                        <span>Gaji Pegawai</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/barang-masuk*') ? 'active' : '' }}"
                        href="{{ route('admin.barang-masuk.index') }}">
                        <i data-feather="hash"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/pemeriksaan-barang*') ? 'active' : '' }}"
                        href="{{ route('admin.pemeriksaan-barang.index') }}">
                        <i data-feather="hash"></i>
                        <span>Pemeriksaan Barang</span>
                    </a>
                </li>



                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/serah-terima-barang*') ? 'active' : '' }}"
                        href="{{ route('admin.serah-terima-barang.index') }}">
                        <i data-feather="hash"></i>
                        <span>Serah Terima Barang</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/laporan-barang-masuk*') ? 'active' : '' }}"
                        href="{{ route('admin.laporan-barang-masuk.index') }}">
                        <i data-feather="hash"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                </li>
                --}}
                @elseif (Auth::user()->role == 'pimpinan')
                    <li class="sidebar-main-title pt-0">
                        <div>
                            <h6>Halaman Pimpinan</h6>
                            <p>Dashboard & Laporan</p>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan') ? 'active' : '' }}"
                            href="{{ route('pimpinan.dashboard') }}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Laporan </h6>
                            <p>...</p>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/pegawai*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.pegawai.index') }}">
                            <i data-feather="hash"></i>
                            <span>Pegawai</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/gaji-pegawai*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.gaji-pegawai.index') }}">
                            <i data-feather="hash"></i>
                            <span>Gaji Pegawai</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/barang-masuk*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.barang-masuk.index') }}">
                            <i data-feather="hash"></i>
                            <span>Barang Masuk</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/pemeriksaan-barang*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.pemeriksaan-barang.index') }}">
                            <i data-feather="hash"></i>
                            <span>Pemeriksaan Barang</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/inventaris*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.inventaris.index') }}">
                            <i data-feather="hash"></i>
                            <span>Inventaris</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/inventaris-ruangan*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.inventaris-ruangan.index') }}">
                            <i data-feather="hash"></i>
                            <span>Inventaris Ruangan</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/serah-terima-barang*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.serah-terima-barang.index') }}">
                            <i data-feather="hash"></i>
                            <span>Serah Terima Barang</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/laporan-barang-masuk*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.laporan-barang-masuk.index') }}">
                            <i data-feather="hash"></i>
                            <span>Laporan Keuangan</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->is('pimpinan/aset-masuk*') ? 'active' : '' }}"
                            href="{{ route('pimpinan.aset-masuk.index') }}">
                            <i data-feather="hash"></i>
                            <span>Aset Masuk</span>
                        </a>
                    </li>
                @endif


                <br><br><br><br>

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
