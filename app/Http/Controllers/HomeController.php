<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function inventarisDetail($id)
    {
        $data = Aset::where(DB::raw('md5(id)'), $id)->first();

        return view('pages.frontend.invetaris-detail', [
            'data' => $data
        ]);
    }

    public function inventarisRuanganDetail($id)
    {
        $data = Ruangan::where(DB::raw('md5(id_ruangan)'), $id)->with(['pegawai', 'inventaris'])->first();

        return view('pages.frontend.invetaris-ruangan-detail', [
            'data' => $data
        ]);
    }

    public function forbidden()
    {
        return view('pages.special.403');
    }

    public function textExport()
    {
        // $asetCollection = Aset::where([
        //     ['nama', '=', 'Revo Mantap'],
        //     ['kode', '=', 'RV1232'],
        //     ['merk', '=', 'Honda'],
        // ])
        //     ->whereBetween('register', [1, 1])
        //     ->orderBy('register', 'ASC')->get();

        // $asetCollection = Aset::where([
        //     ['nama', '=', 'Kursi Lipat'],
        //     ['kode', '=', '8398249'],
        //     ['merk', '=', 'Chitose'],
        // ])
        //     ->whereBetween('register', [1, 4])
        //     ->orderBy('register', 'ASC')->get();

        $pdf = Pdf::loadView('print.print-bast', [
            // 'data' => $asetCollection
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
    }


}
