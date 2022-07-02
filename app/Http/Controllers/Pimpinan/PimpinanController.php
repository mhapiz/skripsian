<?php

namespace App\Http\Controllers\Pimpinan;

use Carbon\Carbon;
use App\Models\Aset;
use App\Models\Inventaris;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PimpinanController extends Controller
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
        return view('pages.pimpinan.dashboard', [
            'bm' => $bm,
            'inven' => $inven,
            'aset' => $aset,
            'pengeluaranTahunIni' => $pengeluaranTahunIni,

        ]);
    }
}
