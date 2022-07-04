<?php

namespace App\Http\Controllers\Pimpinan;

use Carbon\Carbon;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PemeriksaanBarang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PimpinanBarangMasukController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.barang-masuk.index');
    }

    public function getData()
    {
        $data = BarangMasuk::with('suplier')->orderBy('tanggal', 'DESC');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('pimpinan.barang-masuk.detail', $row->id_barang_masuk);

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('total_harga', function ($row) {
                return 'Rp. ' . number_format($row->total_harga, 0, ',', '.');
            })
            ->editColumn('suplier', function ($row) {
                return $row->suplier->nama_suplier;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->findOrFail($id);


        return view('pages.pimpinan.barang-masuk.detail', [
            'data' => $data
        ]);
    }

    public function printRekap(Request $request)
    {
        if ($request->semua) {
            $data = BarangMasuk::with(['suplier'])->get();
        } else {
            $data = BarangMasuk::with(['suplier'])->whereBetween('tanggal', [$request->dari_tanggal, $request->sampai_tanggal])->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-barang-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printDetail($id)
    {
        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-barang-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
