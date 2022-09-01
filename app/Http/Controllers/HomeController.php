<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function inventarisDetail($id)
    {
        $data = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->with('ruangan')->first();

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
}
