<?php

use App\Http\Controllers\Admin\AdminAsetController;
use App\Http\Controllers\Admin\AdminAsetMasukController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Admin\AdminBarangMasukController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminGajiPegawaiController;
use App\Http\Controllers\Admin\AdminInventarisController;
use App\Http\Controllers\Admin\AdminInventarisRuanganController;
use App\Http\Controllers\Admin\AdminLaporanBarangMasukController;
use App\Http\Controllers\Admin\AdminMutasiController;
use App\Http\Controllers\Admin\AdminPangkatController;
use App\Http\Controllers\Admin\AdminPegawaiController;
use App\Http\Controllers\Admin\AdminPemeriksaanBarangController;
use App\Http\Controllers\Admin\AdminPenggunaController;
use App\Http\Controllers\Admin\AdminRuanganController;
use App\Http\Controllers\Admin\AdminSerahTerimaController;
use App\Http\Controllers\Admin\AdminSuplierController;
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


Route::get('/', function () {
    return redirect()->route('login.view');
});

Route::get('/print', [AdminController::class, 'print'])->name('print');

Route::post('autocomplete-barang', [AutoCompleteController::class, 'autocompleteBarang'])->name('autocompleteBarang');
Route::post('autocomplete-aset', [AutoCompleteController::class, 'autocompleteAset'])->name('autocompleteAset');

Route::get('detail/{id}', [HomeController::class, 'inventarisDetail'])->name('inventaris-detail');

Route::get('profil', [UserProfileController::class, 'index'])->name('my-profile');
Route::put('profil/update/{id}', [UserProfileController::class, 'update'])->name('update.my-profile');


Route::prefix('admin')
    ->middleware('auth')
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

        // Pangkat
        Route::prefix('pangkat')->group(function () {
            Route::get('/', [AdminPangkatController::class, 'index'])->name('admin.pangkat.index');
            Route::get('get-data', [AdminPangkatController::class, 'getData'])->name('admin.pangkat.getData');

            Route::get('/create', [AdminPangkatController::class, 'create'])->name('admin.pangkat.create');
            Route::post('/store', [AdminPangkatController::class, 'store'])->name('admin.pangkat.store');

            Route::get('/edit/{id}', [AdminPangkatController::class, 'edit'])->name('admin.pangkat.edit');
            Route::put('/update/{id}', [AdminPangkatController::class, 'update'])->name('admin.pangkat.update');

            Route::delete('/destroy/{id}', [AdminPangkatController::class, 'destroy'])->name('admin.pangkat.destroy');
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

        // Suplier
        Route::prefix('suplier')->group(function () {
            Route::get('/', [AdminSuplierController::class, 'index'])->name('admin.suplier.index');
            Route::get('get-data', [AdminSuplierController::class, 'getData'])->name('admin.suplier.getData');

            Route::get('/create', [AdminSuplierController::class, 'create'])->name('admin.suplier.create');
            Route::post('/store', [AdminSuplierController::class, 'store'])->name('admin.suplier.store');

            Route::get('/edit/{id}', [AdminSuplierController::class, 'edit'])->name('admin.suplier.edit');
            Route::put('/update/{id}', [AdminSuplierController::class, 'update'])->name('admin.suplier.update');

            Route::delete('/destroy/{id}', [AdminSuplierController::class, 'destroy'])->name('admin.suplier.destroy');
        });

        // Barang
        Route::prefix('barang')->group(function () {
            Route::get('/', [AdminBarangController::class, 'index'])->name('admin.barang.index');
            Route::get('get-data', [AdminBarangController::class, 'getData'])->name('admin.barang.getData');

            Route::get('/create', [AdminBarangController::class, 'create'])->name('admin.barang.create');
            Route::post('/store', [AdminBarangController::class, 'store'])->name('admin.barang.store');

            Route::get('/edit/{id}', [AdminBarangController::class, 'edit'])->name('admin.barang.edit');
            Route::put('/update/{id}', [AdminBarangController::class, 'update'])->name('admin.barang.update');

            Route::delete('/destroy/{id}', [AdminBarangController::class, 'destroy'])->name('admin.barang.destroy');
        });

        //Gaji Pegawai
        Route::prefix('gaji-pegawai')->group(function () {
            Route::get('/', [AdminGajiPegawaiController::class, 'index'])->name('admin.gaji-pegawai.index');
            Route::get('get-data', [AdminGajiPegawaiController::class, 'getData'])->name('admin.gaji-pegawai.getData');

            Route::get('/print-rekap', [AdminGajiPegawaiController::class, 'printRekap'])->name('admin.gaji-pegawai.printRekap');
            Route::get('/slip-gaji/{id}', [AdminGajiPegawaiController::class, 'printDetail'])->name('admin.gaji-pegawai.printDetail');


            Route::get('/store-this-month', [AdminGajiPegawaiController::class, 'storeMore'])->name('admin.gaji-pegawai.storeMore');

            Route::get('/create', [AdminGajiPegawaiController::class, 'create'])->name('admin.gaji-pegawai.create');
            Route::post('/store', [AdminGajiPegawaiController::class, 'store'])->name('admin.gaji-pegawai.store');

            Route::get('/edit/{id}', [AdminGajiPegawaiController::class, 'edit'])->name('admin.gaji-pegawai.edit');
            Route::put('/update/{id}', [AdminGajiPegawaiController::class, 'update'])->name('admin.gaji-pegawai.update');

            Route::delete('/destroy/{id}', [AdminGajiPegawaiController::class, 'destroy'])->name('admin.gaji-pegawai.destroy');
        });

        // Barang Masuk
        Route::prefix('barang-masuk')->group(function () {
            Route::get('/', [AdminBarangMasukController::class, 'index'])->name('admin.barang-masuk.index');
            Route::get('get-data', [AdminBarangMasukController::class, 'getData'])->name('admin.barang-masuk.getData');

            Route::get('/detail/{id}', [AdminBarangMasukController::class, 'detail'])->name('admin.barang-masuk.detail');

            Route::get('/print-pemeriksaan/{id}', [AdminBarangMasukController::class, 'printPemeriksaan'])->name('admin.barang-masuk.printPemeriksaan');
            Route::post('/print-rekap', [AdminBarangMasukController::class, 'printRekap'])->name('admin.barang-masuk.printRekap');
            Route::get('/print-detail/{id}', [AdminBarangMasukController::class, 'printDetail'])->name('admin.barang-masuk.printDetail');

            Route::get('/add-to-inventaris/{id}', [AdminBarangMasukController::class, 'addToInventaris'])->name('admin.barang-masuk.addToInventaris');

            Route::get('/create', [AdminBarangMasukController::class, 'create'])->name('admin.barang-masuk.create');
            Route::post('/store', [AdminBarangMasukController::class, 'store'])->name('admin.barang-masuk.store');

            Route::get('/edit/{id}', [AdminBarangMasukController::class, 'edit'])->name('admin.barang-masuk.edit');
            Route::put('/update/{id}', [AdminBarangMasukController::class, 'update'])->name('admin.barang-masuk.update');

            Route::delete('/destroy/{id}', [AdminBarangMasukController::class, 'destroy'])->name('admin.barang-masuk.destroy');
        });

        // Pemeriksaan Barang
        Route::prefix('pemeriksaan-barang')->group(function () {
            Route::get('/', [AdminPemeriksaanBarangController::class, 'index'])->name('admin.pemeriksaan-barang.index');
            Route::get('get-data', [AdminPemeriksaanBarangController::class, 'getData'])->name('admin.pemeriksaan-barang.getData');

            Route::get('/create', [AdminPemeriksaanBarangController::class, 'create'])->name('admin.pemeriksaan-barang.create');
            Route::post('/store', [AdminPemeriksaanBarangController::class, 'store'])->name('admin.pemeriksaan-barang.store');

            Route::get('/print-pemeriksaan/{id}', [AdminPemeriksaanBarangController::class, 'printPemeriksaan'])->name('admin.pemeriksaan-barang.printPemeriksaan');
            Route::post('/print-rekap', [AdminPemeriksaanBarangController::class, 'printRekap'])->name('admin.pemeriksaan-barang.printRekap');

            Route::get('/edit/{id}', [AdminPemeriksaanBarangController::class, 'edit'])->name('admin.pemeriksaan-barang.edit');
            Route::put('/update/{id}', [AdminPemeriksaanBarangController::class, 'update'])->name('admin.pemeriksaan-barang.update');

            Route::delete('/destroy/{id}', [AdminPemeriksaanBarangController::class, 'destroy'])->name('admin.pemeriksaan-barang.destroy');
        });

        //Serah Terima Barang
        Route::prefix('serah-terima-barang')->group(function () {
            Route::get('/', [AdminSerahTerimaController::class, 'index'])->name('admin.serah-terima-barang.index');
            Route::get('get-data', [AdminSerahTerimaController::class, 'getData'])->name('admin.serah-terima-barang.getData');

            Route::get('/print-serah-terima/{id}', [AdminSerahTerimaController::class, 'printSerahTerima'])->name('admin.serah-terima-barang.printSerahTerima');
            Route::post('/print-rekap', [AdminSerahTerimaController::class, 'printRekap'])->name('admin.serah-terima-barang.printRekap');
        });

        // Inventaris
        Route::prefix('inventaris')->group(function () {
            Route::get('/', [AdminInventarisController::class, 'index'])->name('admin.inventaris.index');
            Route::get('get-data', [AdminInventarisController::class, 'getData'])->name('admin.inventaris.getData');

            Route::post('/print-rekap', [AdminInventarisController::class, 'printRekap'])->name('admin.inventaris.printRekap');

            Route::get('detail/{id}', [AdminInventarisController::class, 'detail'])->name('admin.inventaris.detail');

            Route::get('/edit/{id}', [AdminInventarisController::class, 'edit'])->name('admin.inventaris.edit');
            Route::put('/update/{id}', [AdminInventarisController::class, 'update'])->name('admin.inventaris.update');

            Route::post('/distribusi', [AdminInventarisController::class, 'distribusi'])->name('admin.inventaris.distribusi');
        });

        // Mutasi Barang
        Route::prefix('mutasi')->group(function () {
            Route::get('/', [AdminMutasiController::class, 'index'])->name('admin.mutasi.index');
            Route::post('/get-barang-inventaris', [AdminMutasiController::class, 'getBarangInventaris'])->name('admin.mutasi.getBarangInventaris');
            Route::post('/validasi-qr-code', [AdminMutasiController::class, 'qrValidation'])->name('admin.mutasi.qrValidation');

            Route::post('/update', [AdminMutasiController::class, 'update'])->name('admin.mutasi.update');
        });

        // Aset Masuk
        Route::prefix('aset-masuk')->group(function () {
            Route::get('/', [AdminAsetMasukController::class, 'index'])->name('admin.aset-masuk.index');
            Route::get('get-data', [AdminAsetMasukController::class, 'getData'])->name('admin.aset-masuk.getData');

            Route::get('/detail/{id}', [AdminAsetMasukController::class, 'detail'])->name('admin.aset-masuk.detail');

            Route::get('/print-pemeriksaan/{id}', [AdminAsetMasukController::class, 'printPemeriksaan'])->name('admin.aset-masuk.printPemeriksaan');
            Route::post('/print-rekap', [AdminAsetMasukController::class, 'printRekap'])->name('admin.aset-masuk.printRekap');
            Route::get('/print-detail/{id}', [AdminAsetMasukController::class, 'printDetail'])->name('admin.aset-masuk.printDetail');

            Route::get('/add-to-inventaris/{id}', [AdminAsetMasukController::class, 'addToInventaris'])->name('admin.aset-masuk.addToInventaris');

            Route::get('/create', [AdminAsetMasukController::class, 'create'])->name('admin.aset-masuk.create');
            Route::post('/store', [AdminAsetMasukController::class, 'store'])->name('admin.aset-masuk.store');

            Route::get('/edit/{id}', [AdminAsetMasukController::class, 'edit'])->name('admin.aset-masuk.edit');
            Route::put('/update/{id}', [AdminAsetMasukController::class, 'update'])->name('admin.aset-masuk.update');

            Route::delete('/destroy/{id}', [AdminAsetMasukController::class, 'destroy'])->name('admin.aset-masuk.destroy');
        });

        // Laporan Barang Masuk
        Route::prefix('laporan-barang-masuk')->group(function () {
            Route::get('/', [AdminLaporanBarangMasukController::class, 'index'])->name('admin.laporan-barang-masuk.index');
            Route::get('get-data', [AdminLaporanBarangMasukController::class, 'getData'])->name('admin.laporan-barang-masuk.getData');

            Route::post('/print-rekap', [AdminLaporanBarangMasukController::class, 'printRekap'])->name('admin.laporan-barang-masuk.printRekap');
        });

        // Inventaris Ruangan
        Route::prefix('inventaris-ruangan')->group(function () {
            Route::get('/', [AdminInventarisRuanganController::class, 'index'])->name('admin.inventaris-ruangan.index');
            Route::get('get-data', [AdminInventarisRuanganController::class, 'getData'])->name('admin.inventaris-ruangan.getData');

            Route::get('/print-rekap', [AdminInventarisRuanganController::class, 'printRekap'])->name('admin.inventaris-ruangan.printRekap');

            Route::get('detail/{id}', [AdminInventarisRuanganController::class, 'detail'])->name('admin.inventaris-ruangan.detail');
            Route::get('/print-detail/{id}', [AdminInventarisRuanganController::class, 'printDetail'])->name('admin.inventaris-ruangan.printDetail');
        });

        // Aset
        Route::prefix('aset')->group(function () {
            Route::get('/', [AdminAsetController::class, 'index'])->name('admin.aset.index');
            Route::get('get-data', [AdminAsetController::class, 'getData'])->name('admin.aset.getData');

            Route::get('/print-rekap', [AdminAsetController::class, 'printRekap'])->name('admin.aset.printRekap');

            Route::get('detail/{id}', [AdminAsetController::class, 'detail'])->name('admin.aset.detail');
        });
    });

Route::prefix('pimpinan')
    ->middleware('auth')
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
