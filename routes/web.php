<?php

use App\Http\Controllers\Admin\AdminAsetController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminInventarisRuanganController;
use App\Http\Controllers\Admin\AdminMutasiController;
use App\Http\Controllers\Admin\AdminPegawaiController;
use App\Http\Controllers\Admin\AdminPenggunaController;
use App\Http\Controllers\Admin\AdminRuanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pimpinan\PimpinanAsetController;
use App\Http\Controllers\Pimpinan\PimpinanAsetMasukController;
use App\Http\Controllers\Pimpinan\PimpinanBarangController;
use App\Http\Controllers\Pimpinan\PimpinanBarangMasukController;
use App\Http\Controllers\Pimpinan\PimpinanController;
use App\Http\Controllers\Pimpinan\PimpinanGajiPegawaiController;
use App\Http\Controllers\Pimpinan\PimpinanInventarisController;
use App\Http\Controllers\Pimpinan\PimpinanInventarisRuanganController;
use App\Http\Controllers\Pimpinan\PimpinanLaporanBarangMasukController;
use App\Http\Controllers\Pimpinan\PimpinanPangkatController;
use App\Http\Controllers\Pimpinan\PimpinanPegawaiController;
use App\Http\Controllers\Pimpinan\PimpinanPemeriksaanBarangController;
use App\Http\Controllers\Pimpinan\PimpinanRuanganController;
use App\Http\Controllers\Pimpinan\PimpinanSerahTerimaController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'index'])->name('login.view');
Route::post('login-proses', [AuthController::class, 'loginProses'])->name('login.proses');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forbidden-access', [HomeController::class, 'forbidden'])->name('forbidden');
Route::get('print', [HomeController::class, 'textExport'])->name('textExport');

Route::get('/', function () {
    return redirect()->route('login.view');
});

// Route::get('/print', [AdminController::class, 'print'])->name('print');

Route::post('autocomplete-barang', [AutoCompleteController::class, 'autocompleteBarang'])->name('autocompleteBarang');
Route::post('autocomplete-aset', [AutoCompleteController::class, 'autocompleteAset'])->name('autocompleteAset');

Route::get('detail/{id}', [HomeController::class, 'inventarisDetail'])->name('inventaris-detail');
Route::get('inventaris-ruangan/{id}', [HomeController::class, 'inventarisRuanganDetail'])->name('inventaris-ruangan-detail');

Route::get('profil', [UserProfileController::class, 'index'])->name('my-profile');
Route::put('profil/update/{id}', [UserProfileController::class, 'update'])->name('update.my-profile');


Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->namespace('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        // Pengguna
        Route::prefix('pengguna')->group(function () {
            Route::get('/', [AdminPenggunaController::class, 'index'])->name('admin.pengguna.index');
            Route::get('get-data', [AdminPenggunaController::class, 'getData'])->name('admin.pengguna.getData');

            Route::get('/create', [AdminPenggunaController::class, 'create'])->name('admin.pengguna.create');
            Route::post('/store', [AdminPenggunaController::class, 'store'])->name('admin.pengguna.store');

            Route::get('/edit/{id}', [AdminPenggunaController::class, 'edit'])->name('admin.pengguna.edit');
            Route::put('/update/{id}', [AdminPenggunaController::class, 'update'])->name('admin.pengguna.update');

            Route::delete('/destroy/{id}', [AdminPenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
        });

        // Pegawai
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [AdminPegawaiController::class, 'index'])->name('admin.pegawai.index');
            Route::get('get-data', [AdminPegawaiController::class, 'getData'])->name('admin.pegawai.getData');

            Route::get('/create', [AdminPegawaiController::class, 'create'])->name('admin.pegawai.create');
            Route::post('/store', [AdminPegawaiController::class, 'store'])->name('admin.pegawai.store');

            Route::get('/print-rekap', [AdminPegawaiController::class, 'printRekap'])->name('admin.pegawai.printRekap');

            Route::get('/edit/{id}', [AdminPegawaiController::class, 'edit'])->name('admin.pegawai.edit');
            Route::put('/update/{id}', [AdminPegawaiController::class, 'update'])->name('admin.pegawai.update');

            Route::delete('/destroy/{id}', [AdminPegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
        });

        // Mutasi Barang
        Route::prefix('mutasi')->group(function () {
            Route::get('/', [AdminMutasiController::class, 'index'])->name('admin.mutasi.index');
            Route::post('/get-barang-inventaris', [AdminMutasiController::class, 'getBarangInventaris'])->name('admin.mutasi.getBarangInventaris');
            Route::post('/validasi-qr-code', [AdminMutasiController::class, 'qrValidation'])->name('admin.mutasi.qrValidation');

            Route::post('/update', [AdminMutasiController::class, 'update'])->name('admin.mutasi.update');

            Route::get('distribusi', [AdminMutasiController::class, 'distribusi'])->name('admin.mutasi.distribusi');
            Route::post('distribusi/aksi', [AdminMutasiController::class, 'distribusiAksi'])->name('admin.mutasi.distribusiAksi');
        });

        // Ruangan
        Route::prefix('ruangan')->group(function () {
            Route::get('/', [AdminRuanganController::class, 'index'])->name('admin.ruangan.index');
            Route::get('get-data', [AdminRuanganController::class, 'getData'])->name('admin.ruangan.getData');

            Route::get('/create', [AdminRuanganController::class, 'create'])->name('admin.ruangan.create');
            Route::post('/store', [AdminRuanganController::class, 'store'])->name('admin.ruangan.store');

            Route::get('/detail/{id}', [AdminRuanganController::class, 'detail'])->name('admin.ruangan.detail');
            Route::get('/print-detail/{id}', [AdminRuanganController::class, 'printDetail'])->name('admin.ruangan.printDetail');

            Route::get('/edit/{id}', [AdminRuanganController::class, 'edit'])->name('admin.ruangan.edit');
            Route::put('/update/{id}', [AdminRuanganController::class, 'update'])->name('admin.ruangan.update');

            Route::delete('/destroy/{id}', [AdminRuanganController::class, 'destroy'])->name('admin.ruangan.destroy');
        });

        // Inventaris Ruangan
        Route::prefix('aset-ruangan')->group(function () {
            Route::get('/', [AdminInventarisRuanganController::class, 'index'])->name('admin.inventaris-ruangan.index');
            Route::get('get-data', [AdminInventarisRuanganController::class, 'getData'])->name('admin.inventaris-ruangan.getData');

            Route::get('/print-rekap', [AdminInventarisRuanganController::class, 'printRekap'])->name('admin.inventaris-ruangan.printRekap');

            Route::get('detail/{id}', [AdminInventarisRuanganController::class, 'detail'])->name('admin.inventaris-ruangan.detail');
            Route::get('/print-detail/{id}', [AdminInventarisRuanganController::class, 'printDetail'])->name('admin.inventaris-ruangan.printDetail');
        });


        // Aset
        Route::prefix('aset')->group(function () {
            Route::get('/', [AdminAsetController::class, 'index'])->name('admin.aset.index');
            Route::get('get-data/{filter?}', [AdminAsetController::class, 'getData'])->name('admin.aset.getData');

            Route::post('/print-rekap', [AdminAsetController::class, 'printRekap'])->name('admin.aset.printRekap');

            Route::get('/tambah-kendaraan-dinas', [AdminAsetController::class, 'createKendaraanDinas'])->name('admin.kendaraan-dinas.create');

            Route::get('/tambah-aset', [AdminAsetController::class, 'createAset'])->name('admin.aset.create');
            Route::post('/store', [AdminAsetController::class, 'store'])->name('admin.aset.store');

            Route::get('detail/{id}', [AdminAsetController::class, 'detail'])->name('admin.aset.detail');

            Route::get('/edit/{id}', [AdminAsetController::class, 'edit'])->name('admin.aset.edit');
            Route::put('/update/{id}', [AdminAsetController::class, 'update'])->name('admin.aset.update');

            Route::post('/distribusi', [AdminAsetController::class, 'distribusi'])->name('admin.aset.distribusi');

            // Route::get('/edit/{id}', [AdminAsetController::class, 'edit'])->name('admin.aset.edit');
        });
    });

Route::prefix('pimpinan')
    ->middleware(['auth', 'isSuperadmin'])
    ->group(function () {
        Route::get('/', [PimpinanController::class, 'index'])->name('pimpinan.dashboard');

        // Pegawai
        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PimpinanPegawaiController::class, 'index'])->name('pimpinan.pegawai.index');
            Route::get('get-data', [PimpinanPegawaiController::class, 'getData'])->name('pimpinan.pegawai.getData');

            Route::get('/print-rekap', [PimpinanPegawaiController::class, 'printRekap'])->name('pimpinan.pegawai.printRekap');
        });

        // Pangkat
        Route::prefix('pangkat')->group(function () {
            Route::get('/', [PimpinanPangkatController::class, 'index'])->name('pimpinan.pangkat.index');
            Route::get('get-data', [PimpinanPangkatController::class, 'getData'])->name('pimpinan.pangkat.getData');
        });

        // Ruangan
        Route::prefix('ruangan')->group(function () {
            Route::get('/', [PimpinanRuanganController::class, 'index'])->name('pimpinan.ruangan.index');
            Route::get('get-data', [PimpinanRuanganController::class, 'getData'])->name('pimpinan.ruangan.getData');

            Route::get('/detail/{id}', [PimpinanRuanganController::class, 'detail'])->name('pimpinan.ruangan.detail');
            Route::get('/print-detail/{id}', [PimpinanRuanganController::class, 'printDetail'])->name('pimpinan.ruangan.printDetail');
        });

        // Suplier

        // Barang
        Route::prefix('barang')->group(function () {
            Route::get('/', [PimpinanBarangController::class, 'index'])->name('pimpinan.barang.index');
            Route::get('get-data', [PimpinanBarangController::class, 'getData'])->name('pimpinan.barang.getData');
        });

        //Gaji Pegawai
        Route::prefix('gaji-pegawai')->group(function () {
            Route::get('/', [PimpinanGajiPegawaiController::class, 'index'])->name('pimpinan.gaji-pegawai.index');
            Route::get('get-data', [PimpinanGajiPegawaiController::class, 'getData'])->name('pimpinan.gaji-pegawai.getData');

            Route::get('/print-rekap', [PimpinanGajiPegawaiController::class, 'printRekap'])->name('pimpinan.gaji-pegawai.printRekap');
            Route::get('/slip-gaji/{id}', [PimpinanGajiPegawaiController::class, 'printDetail'])->name('pimpinan.gaji-pegawai.printDetail');
        });

        // Barang Masuk
        Route::prefix('barang-masuk')->group(function () {
            Route::get('/', [PimpinanBarangMasukController::class, 'index'])->name('pimpinan.barang-masuk.index');
            Route::get('get-data', [PimpinanBarangMasukController::class, 'getData'])->name('pimpinan.barang-masuk.getData');

            Route::get('/detail/{id}', [PimpinanBarangMasukController::class, 'detail'])->name('pimpinan.barang-masuk.detail');

            Route::get('/print-pemeriksaan/{id}', [PimpinanBarangMasukController::class, 'printPemeriksaan'])->name('pimpinan.barang-masuk.printPemeriksaan');
            Route::post('/print-rekap', [PimpinanBarangMasukController::class, 'printRekap'])->name('pimpinan.barang-masuk.printRekap');
            Route::get('/print-detail/{id}', [PimpinanBarangMasukController::class, 'printDetail'])->name('pimpinan.barang-masuk.printDetail');
        });

        // Pemeriksaan Barang
        Route::prefix('pemeriksaan-barang')->group(function () {
            Route::get('/', [PimpinanPemeriksaanBarangController::class, 'index'])->name('pimpinan.pemeriksaan-barang.index');
            Route::get('get-data', [PimpinanPemeriksaanBarangController::class, 'getData'])->name('pimpinan.pemeriksaan-barang.getData');

            Route::get('/print-pemeriksaan/{id}', [PimpinanPemeriksaanBarangController::class, 'printPemeriksaan'])->name('pimpinan.pemeriksaan-barang.printPemeriksaan');
            Route::post('/print-rekap', [PimpinanPemeriksaanBarangController::class, 'printRekap'])->name('pimpinan.pemeriksaan-barang.printRekap');
        });

        //Serah Terima Barang
        Route::prefix('serah-terima-barang')->group(function () {
            Route::get('/', [PimpinanSerahTerimaController::class, 'index'])->name('pimpinan.serah-terima-barang.index');
            Route::get('get-data', [PimpinanSerahTerimaController::class, 'getData'])->name('pimpinan.serah-terima-barang.getData');

            Route::get('/print-serah-terima/{id}', [PimpinanSerahTerimaController::class, 'printSerahTerima'])->name('pimpinan.serah-terima-barang.printSerahTerima');
            Route::post('/print-rekap', [PimpinanSerahTerimaController::class, 'printRekap'])->name('pimpinan.serah-terima-barang.printRekap');
        });

        // Inventaris
        Route::prefix('inventaris')->group(function () {
            Route::get('/', [PimpinanInventarisController::class, 'index'])->name('pimpinan.inventaris.index');
            Route::get('get-data', [PimpinanInventarisController::class, 'getData'])->name('pimpinan.inventaris.getData');

            Route::post('/print-rekap', [PimpinanInventarisController::class, 'printRekap'])->name('pimpinan.inventaris.printRekap');

            Route::get('detail/{id}', [PimpinanInventarisController::class, 'detail'])->name('pimpinan.inventaris.detail');
        });

        // Mutasi Barang

        // Aset Masuk
        Route::prefix('aset-masuk')->group(function () {
            Route::get('/', [PimpinanAsetMasukController::class, 'index'])->name('pimpinan.aset-masuk.index');
            Route::get('get-data', [PimpinanAsetMasukController::class, 'getData'])->name('pimpinan.aset-masuk.getData');

            Route::get('/detail/{id}', [PimpinanAsetMasukController::class, 'detail'])->name('pimpinan.aset-masuk.detail');

            Route::get('/print-pemeriksaan/{id}', [PimpinanAsetMasukController::class, 'printPemeriksaan'])->name('pimpinan.aset-masuk.printPemeriksaan');
            Route::post('/print-rekap', [PimpinanAsetMasukController::class, 'printRekap'])->name('pimpinan.aset-masuk.printRekap');
            Route::get('/print-detail/{id}', [PimpinanAsetMasukController::class, 'printDetail'])->name('pimpinan.aset-masuk.printDetail');
        });

        // Laporan Barang Masuk
        Route::prefix('laporan-barang-masuk')->group(function () {
            Route::get('/', [PimpinanLaporanBarangMasukController::class, 'index'])->name('pimpinan.laporan-barang-masuk.index');
            Route::get('get-data', [PimpinanLaporanBarangMasukController::class, 'getData'])->name('pimpinan.laporan-barang-masuk.getData');

            Route::post('/print-rekap', [PimpinanLaporanBarangMasukController::class, 'printRekap'])->name('pimpinan.laporan-barang-masuk.printRekap');
        });

        // Inventaris Ruangan
        Route::prefix('inventaris-ruangan')->group(function () {
            Route::get('/', [PimpinanInventarisRuanganController::class, 'index'])->name('pimpinan.inventaris-ruangan.index');
            Route::get('get-data', [PimpinanInventarisRuanganController::class, 'getData'])->name('pimpinan.inventaris-ruangan.getData');

            Route::get('/print-rekap', [PimpinanInventarisRuanganController::class, 'printRekap'])->name('pimpinan.inventaris-ruangan.printRekap');

            Route::get('detail/{id}', [PimpinanInventarisRuanganController::class, 'detail'])->name('pimpinan.inventaris-ruangan.detail');
            Route::get('/print-detail/{id}', [PimpinanInventarisRuanganController::class, 'printDetail'])->name('pimpinan.inventaris-ruangan.printDetail');
        });

        // Aset
        Route::prefix('aset')->group(function () {
            Route::get('/', [PimpinanAsetController::class, 'index'])->name('pimpinan.aset.index');
            Route::get('get-data', [PimpinanAsetController::class, 'getData'])->name('pimpinan.aset.getData');

            Route::get('/print-rekap', [PimpinanAsetController::class, 'printRekap'])->name('pimpinan.aset.printRekap');

            Route::get('detail/{id}', [PimpinanAsetController::class, 'detail'])->name('pimpinan.aset.detail');
        });
    });
