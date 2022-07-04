<?php

namespace App\Http\Controllers\Pimpinan;

use App\Models\Ruangan;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PimpinanInventarisController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('pages.pimpinan.inventaris.index', [
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
                $detailUrl = route('pimpinan.inventaris.detail', md5($row->id_inventaris));

                return view('modules.backend._formActionDetail', compact('detailUrl'));
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

        return view('pages.pimpinan.inventaris.detail', [
            'data' => $data
        ]);
    }
}
