<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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

    public function distribusi()
    {
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        return view('pages.admin.mutasi.distribusi', [
            'pegawai' => $pegawai,
            'ruangan' => $ruangan
        ]);
    }

    public function distribusiAksi(Request $request)
    {
        try {
            $request->validate([
                'jenis_kepemilikan' => 'required',
                'jumlahAset' => 'required|numeric|min:1', // Validate jumlahAset
                'aset_id.*' => 'nullable', // Aset bisa null jika lebih dari jumlahAset
                'jumlah_tersedia.*' => 'nullable', // Jumlah tersedia bisa null jika lebih dari jumlahAset
                'jumlah_distribusi.*' => 'nullable', // Jumlah distribusi bisa null jika lebih dari jumlahAset
            ]);

            // Custom validation for aset_id, jumlah_tersedia, and jumlah_distribusi
            $jumlahAset = $request->input('jumlahAset');
            $asetIds = $request->input('aset_id');
            $jumlahTersedia = $request->input('jumlah_tersedia');
            $jumlahDistribusi = $request->input('jumlah_distribusi');

            for ($i = 0; $i < $jumlahAset; $i++) {
                if (empty($asetIds[$i]) || empty($jumlahTersedia[$i]) || empty($jumlahDistribusi[$i])) {
                    throw ValidationException::withMessages(['validation' => 'Harap isi semua kolom dengan benar']);
                }
            }
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        }

        $allReq = $request->all();
        $req['jenis_kepemilikan'] = $allReq['jenis_kepemilikan'];
        $req['aset_id'] = $allReq['aset_id'];
        $req['jumlah_tersedia'] = $allReq['jumlah_tersedia'];
        $req['jumlah_distribusi'] = $allReq['jumlah_distribusi'];
        $req['kondisi'] = $allReq['kondisi'];

        if ($req['jenis_kepemilikan'] == 'ruangan') {
            $request->validate([
                'ruangan_id' => 'required',
            ]);
            $req['ruangan_id'] = $allReq['ruangan_id'];
        } elseif ($req['jenis_kepemilikan'] == 'pegawai') {
            $request->validate([
                'pegawai_id' => 'required',
            ]);
            $req['pegawai_id'] = $allReq['pegawai_id'];
        }
        foreach ($request->aset_id as $key => $value) {
            if ($req['jumlah_distribusi'][$key] > $req['jumlah_tersedia'][$key]) {
                Alert::error('Gagal', 'Salah Satu Jumlah Distribusi Melebihi Jumlah Tersedia');
                return redirect()->back();
            }
        }

        foreach ($request->aset_id as $key => $value) {
            if ($key == $jumlahAset) {
                break;
            }
            $aset = Aset::find($req['aset_id'][$key]);
            $asetFree = Aset::where([
                ['nama', '=', $aset->nama],
                ['kode', '=', $aset->kode],
                ['merk', '=', $aset->merk],
                ['ruangan_id', null],
                ['pegawai_id', null],
                ['kondisi', $req['kondisi'][$key]]
            ])->orderBy('register', 'ASC')->get();

            if ($asetFree == null) {
                $asetFree = Aset::where([
                    ['nama', '=', $aset->nama],
                    ['kode', '=', $aset->kode],
                    ['merk', '=', $aset->merk],
                    ['ruangan_id', null],
                    ['pegawai_id', null]
                ])->orderBy('register', 'ASC')->get();
            }

            for ($i = 1; $i <= $req['jumlah_distribusi'][$key]; $i++) {
                if ($req['jenis_kepemilikan'] == 'ruangan') {
                    $asetFree->first()->update([
                        'ruangan_id' => $req['ruangan_id'],
                    ]);
                } elseif ($req['jenis_kepemilikan'] == 'pegawai') {
                    $asetFree->first()->update([
                        'pegawai_id' => $req['pegawai_id'],
                    ]);
                }
                $asetFree->first()->update([
                    'jenis_kepemilikan' => $req['jenis_kepemilikan'],
                ]);
                $asetFree->shift();
            }
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.aset.index');
    }
}
