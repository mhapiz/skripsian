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

                <li class="sidebar-main-title pt-0">
                    <div>
                        <h6>Halaman Admin</h6>
                        <p>Dashboard & Overview</p>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Master Data</h6>
                        <p>Pegawai, Ruangan, Barang</p>
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
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/pangkat*') ? 'active' : '' }}"
                        href="{{ route('admin.pangkat.index') }}">
                        <i data-feather="hash"></i>
                        <span>Pangkat</span>
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
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/suplier*') ? 'active' : '' }}"
                        href="{{ route('admin.suplier.index') }}">
                        <i data-feather="hash"></i>
                        <span>Suplier</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/barang') || request()->is('admin/barang/create') || request()->is('admin/barang/edit*') ? 'active' : '' }}"
                        href="{{ route('admin.barang.index') }}">
                        <i data-feather="hash"></i>
                        <span>Barang</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/aset*') ? 'active' : '' }}"
                        href="{{ route('admin.aset.index') }}">
                        <i data-feather="hash"></i>
                        <span>Aset </span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Transaksi </h6>
                        <p>Inventaris, Barang Masuk & Keluar</p>
                    </div>
                </li>

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
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/inventaris*') ? 'active' : '' }}"
                        href="{{ route('admin.inventaris.index') }}">
                        <i data-feather="hash"></i>
                        <span>Inventaris</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/inventaris-ruangan*') ? 'active' : '' }}"
                        href="{{ route('admin.inventaris-ruangan.index') }}">
                        <i data-feather="hash"></i>
                        <span>Inventaris Ruangan</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/serah-terima-barang*') ? 'active' : '' }}"
                        href="{{ route('admin.serah-terima-barang.index') }}">
                        <i data-feather="hash"></i>
                        <span>Serah Terima Barang</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/mutasi*') ? 'active' : '' }}"
                        href="{{ route('admin.mutasi.index') }}">
                        <i data-feather="hash"></i>
                        <span>Mutasi Barang</span>
                    </a>
                </li> --}}

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/laporan-barang-masuk*') ? 'active' : '' }}"
                        href="{{ route('admin.laporan-barang-masuk.index') }}">
                        <i data-feather="hash"></i>
                        <span>Laporan Barang Masuk</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav {{ request()->is('admin/aset-masuk*') ? 'active' : '' }}"
                        href="{{ route('admin.aset-masuk.index') }}">
                        <i data-feather="hash"></i>
                        <span>Aset Masuk</span>
                    </a>
                </li>



                {{-- <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="#">
                        <i data-feather="book"></i>
                        <span>Jadwal Pelajaran</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="active">
                            <a href="{{ url('/dashboard/jadwal-pelajaran') }}">
                                Data Jadwal Pelajaran
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard/jadwal-pelajaran/atur-jadwal') }}">
                                Atur & Tambah Jadwal Pelajaran
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <br><br><br><br>

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
