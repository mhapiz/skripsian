<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailSerahTerima;
use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\SerahTerima;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class AdminInventarisController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('pages.admin.inventaris.index', [
            'ruangan' => $ruangan
        ]);
    }

    public function getData(Request $request)
    {
        if (!empty($request->ruangan)) {
            if ($request->ruangan == '-') {
                $data = Inventaris::with(['barang', 'ruangan'])->where('ruangan_id', '=', null)->orderBy('ruangan_id', 'ASC')->latest();
            } else {
                $data = Inventaris::with(['barang', 'ruangan'])->where('ruangan_id', '=', $request->ruangan)->orderBy('ruangan_id', 'ASC')->latest();
            }
        } else {
            $data = Inventaris::with(['barang', 'ruangan'])->orderBy('ruangan_id', 'ASC')->latest();
        }

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.inventaris.edit', $row->id_inventaris);
                $detailUrl = route('admin.inventaris.detail', md5($row->id_inventaris));

                return view('modules.backend._formActionEditAndDetail', compact('editUrl', 'detailUrl'));
            })
            ->editColumn('nama_barang', function ($row) {
                return $row->barang->nama_barang;
            })
            ->editColumn('ruangan', function ($row) {
                if ($row->ruangan_id == null) {
                    return 'Belum Ditempatkan';
                } else {
                    return $row->ruangan->nama_ruangan;
                }
            })
            ->editColumn('kode', function ($row) {
                return $row->barang->kode_barang . ' - ' . $row->register;
            })
            // ->editColumn('qr', function ($row) {
            //     return QrCode::size(150)->generate(route('inventaris-detail', md5($row->id_inventaris)));
            // })
            ->editColumn('kondisi', function ($row) {
                if ($row->kondisi == 'baik') {
                    return '<div class="badge badge-pill badge-success">Baik</div>';
                } elseif ($row->kondisi == 'cukup_baik') {
                    return '<div class="badge badge-pill badge-light">Cukup Baik</div>';
                } elseif ($row->kondisi == 'rusak') {
                    return '<div class="badge badge-pill badge-warning">Rusak</div>';
                } elseif ($row->kondisi == 'rusak_berat') {
                    return '<div class="badge badge-pill badge-danger">Rusak Berat</div>';
                }
            })
            ->rawColumns(['aksi', 'kondisi'])
            ->make(true);
    }

    public function printRekap(Request $request)
    {
        if ($request->kondisi == '') {
            $data = Inventaris::with(['barang', 'ruangan'])->get();
        } else {
            $data = Inventaris::with(['barang', 'ruangan'])->where('kondisi', '=', $request->kondisi)->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-inventaris-semua', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function detail($id)
    {
        $data = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->with('ruangan')->first();
        if ($data->ruangan) {
            $pegawai = Pegawai::find($data->ruangan->pegawai_id);
        } else{
            $pegawai = null;
        }
        return view('pages.admin.inventaris.detail', [
            'data' => $data,
            'pegawai' => $pegawai
        ]);
    }

    public function edit($id)
    {
        $data = Inventaris::find($id);
        $ruangan = Ruangan::all();
        return view('pages.admin.inventaris.edit', [
            'data' => $data,
            'ruangan' => $ruangan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $request->validate([
            'kondisi' => 'required',
            'ruangan_id' => 'required',
        ]);

        Inventaris::find($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.inventaris.index');
    }

    public function distribusi(Request $request)
    {
        $req = $request->validate([
            'ruangan_id' => 'required',
            'no_serah_terima' => 'required',
            'tanggal_serah_terima' => 'required',
            //---
            'barang_id' => 'required',
            'jumlah_tersedia' => 'required',
            'jumlah_distribusi' => 'required',
        ]);

        foreach ($request->barang_id as $key => $value) {
            if ($req['jumlah_distribusi'][$key] > $req['jumlah_tersedia'][$key]) {
                Alert::error('Gagal', 'Salah Satu Jumlah Distribusi Melebihi Jumlah Tersedia');
                return redirect()->back();
            }
        }

        $st = SerahTerima::create([
            'no_serah_terima' => $req['no_serah_terima'],
            'tanggal_serah_terima' => $req['tanggal_serah_terima'],
            'ruangan_id' => $req['ruangan_id'],
        ]);

        foreach ($request->barang_id as $key => $value) {

            $barangFree = Inventaris::where('barang_id', $req['barang_id'][$key])->where('ruangan_id', null)->orderBy('register', 'ASC')->get();

            for ($i = 1; $i <= $req['jumlah_distribusi'][$key]; $i++) {
                $barangFree->first()->update([
                    'ruangan_id' => $req['ruangan_id'],
                ]);
                $barangFree->shift();
            }

            DetailSerahTerima::create([
                'serah_terima_id' => $st->id_serah_terima,
                'barang_id' => $req['barang_id'][$key],
                'jumlah' => $req['jumlah_distribusi'][$key],
            ]);
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.inventaris.index');
    }
}
