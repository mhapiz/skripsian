<?php

namespace App\Http\Controllers\Pimpinan;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\SerahTerima;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Riskihajar\Terbilang\Facades\Terbilang;

class PimpinanSerahTerimaController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.serah-terima-barang.index');
    }

    public function getData()
    {
        $data = SerahTerima::with('ruangan')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $url = route('pimpinan.serah-terima-barang.printSerahTerima', $row->id_serah_terima);

                return view('modules.backend._defaultPrint', compact('url'));
            })
            ->editColumn('ruangan', function ($row) {
                return $row->ruangan->nama_ruangan;
            })
            ->editColumn('tanggal_serah_terima', function ($row) {
                return Carbon::parse($row->tanggal_serah_terima)->isoFormat('dddd, D MMMM Y');
            })
            ->rawColumns(['aksi', 'pemeriksa'])
            ->make(true);
    }

    public function printSerahTerima($id)
    {
        $data = SerahTerima::select(['id_serah_terima', 'no_serah_terima', 'tanggal_serah_terima', 'ruangan_id'])
            ->with(['ruangan', 'detail'])->find($id);

        $kepala_ruangan = Pegawai::where('id_pegawai', $data->ruangan->pegawai_id)->first();
        $terbilang['tgl'] = Terbilang::make(Carbon::parse($data->tanggal_serah_terima)->isoFormat('D'));
        $terbilang['tahun'] = Terbilang::make(Carbon::parse($data->tanggal_serah_terima)->isoFormat('Y'));

        $pdf = Pdf::loadView('print.print-serah-terima', [
            'data' => $data,
            'terbilang' => $terbilang,
            'kepala_ruangan' => $kepala_ruangan,
        ]);

        return $pdf->stream();
    }

    public function printRekap(Request $request)
    {
        if ($request->semua) {
            $data = SerahTerima::with('ruangan')->latest()->get();
        } else {
            $data = SerahTerima::with('ruangan')->whereBetween('tanggal_serah_terima', [$request->dari_tanggal, $request->sampai_tanggal])->latest()->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-serah-terima', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
