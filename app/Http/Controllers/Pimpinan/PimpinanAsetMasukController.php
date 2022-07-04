<?php

namespace App\Http\Controllers\Pimpinan;

use Carbon\Carbon;
use App\Models\AsetMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PimpinanAsetMasukController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.aset-masuk.index');
    }

    public function getData()
    {
        $data = AsetMasuk::with('suplier')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('pimpinan.aset-masuk.detail', $row->id_aset_masuk);

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('suplier', function ($row) {
                return $row->suplier->nama_suplier;
            })
            ->editColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('total_harga', function ($row) {
                return 'Rp ' . number_format($row->total_harga, 0, ',', '.');
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = AsetMasuk::with(['suplier', 'detail_aset_masuk'])->findOrFail($id);

        return view('pages.pimpinan.aset-masuk.detail', [
            'data' => $data
        ]);
    }

    public function printPemeriksaan($id)
    {
        return redirect()->route('pimpinan.aset-masuk.printDetail', $id);
    }

    public function printRekap(Request $request)
    {
        if ($request->semua) {
            $data = AsetMasuk::with(['suplier'])->get();
        } else {
            $data = AsetMasuk::with(['suplier'])->whereBetween('tanggal', [$request->dari_tanggal, $request->sampai_tanggal])->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-aset-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printDetail($id)
    {
        $data = AsetMasuk::with(['suplier', 'detail_aset_masuk'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-aset-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
