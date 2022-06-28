<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Barang;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function autocompleteBarang(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $barangs = Barang::orderby('nama_barang', 'asc')->select('kode_barang', 'nama_barang')->distinct()->limit(5)->get();
        } else {
            $barangs = Barang::orderby('nama_barang', 'asc')->select('kode_barang', 'nama_barang')->where('nama_barang', 'like', '%' . $search . '%')->distinct()->limit(5)->get();
        }

        $response = array();
        foreach ($barangs as $b) {
            $response[] = array(
                "label" => $b->nama_barang,
                "kode_barang" => $b->kode_barang,
            );
        }

        return response()->json($response);
    }

    public function autocompleteAset(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $barangs = Aset::orderby('nama_aset', 'asc')->select('kode_aset', 'nama_aset')->distinct('kode_aset')->limit(5)->get();
        } else {
            $barangs = Aset::orderby('nama_aset', 'asc')->select('kode_aset', 'nama_aset')->where('nama_aset', 'like', '%' . $search . '%')->distinct('kode_aset')->limit(5)->get();
        }

        $response = array();
        foreach ($barangs as $b) {
            $response[] = array(
                "label" => $b->nama_aset,
                "kode_aset" => $b->kode_aset,
            );
        }

        return response()->json($response);
    }
}
