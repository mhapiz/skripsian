<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\BarangMasuk;
use App\Models\Inventaris;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tahunIni = Carbon::now()->year;
        $bm = BarangMasuk::selectRaw('year(tanggal) as year, month(tanggal) as month, sum(total_harga) as total_belanja')
            ->groupBy('year', 'month')
            ->whereYear('tanggal', '=', $tahunIni)
            ->orderByRaw('min(created_at) asc')->get();
        $pengeluaranTahunIni = BarangMasuk::selectRaw('sum(total_harga) as total')
            ->whereYear('tanggal', '=', $tahunIni)->first();
        $inven = Inventaris::get()->count();
        $aset = Aset::get()->count();
        return view('pages.admin.dashboard', [
            'bm' => $bm,
            'inven' => $inven,
            'aset' => $aset,
            'pengeluaranTahunIni' => $pengeluaranTahunIni,

        ]);
    }

    public function print()
    {
        $pdf = Pdf::loadView('print.test');

        return $pdf->stream();
    }
}
