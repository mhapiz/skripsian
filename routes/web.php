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
