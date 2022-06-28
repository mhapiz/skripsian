<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMutasiController extends Controller
{
    public function index()
    {
        $inventaris = Inventaris::with('barang')->get();
        $ruangan = Ruangan::all();
        return view('pages.admin.mutasi.index', [
            'inventaris' => $inventaris,
            'ruangan' => $ruangan,
        ]);
    }

    public function getBarangInventaris(Request $request)
    {
        $id = $request->get('id');

        $inven = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->with('ruangan')->first();

        if (!$inven) {
            echo null;
        } else {

            if ($inven->ruangan_id == null) {
                $ruangan = '-';
            } else {
                $ruangan = $inven->ruangan->nama_ruangan;
            }

            echo $ruangan;
        }
    }

    public function qrValidation(Request $request)
    {
        $id = $request->qr;
        $inven = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->first();
        if ($inven == null) {
            return response()->json([
                'status' => 'failed'
            ]);
        } else {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function update(Request $request)
    {
        $req = $request->validate([
            'id_inventaris' => 'required',
            'id_ruangan' => 'required',
        ]);

        $inven = Inventaris::where(DB::raw('md5(id_inventaris)'), $req['id_inventaris'])->with('ruangan')->first();

        if (!$inven) {
            return redirect()->route('admin.mutasi.index')->with('error', 'Data tidak ditemukan');
        } else {
            if ($inven->ruangan_id == null) {
                return redirect()->route('admin.mutasi.index')->with('error', 'Barang inventaris belum ditempatkan');
            } else {
                $inven->ruangan_id = $req['id_ruangan'];
                $inven->save();
                return redirect()->route('admin.mutasi.index')->with('success', 'Barang Inventaris berhasil dimutasi');
            }
        }
    }
}
