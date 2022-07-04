<?php

namespace App\Http\Controllers\Pimpinan;

use Carbon\Carbon;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PemeriksaanBarang;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Riskihajar\Terbilang\Facades\Terbilang;

class PimpinanPemeriksaanBarangController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.pemeriksaan-barang.index');
    }

    public function getData()
    {
        $data = PemeriksaanBarang::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $printUrl = route('pimpinan.pemeriksaan-barang.printPemeriksaan', $row->id_pemeriksaan_barang);

                return view('modules.backend._formActionPrint', compact('printUrl'));
            })
            ->editColumn('tanggal_pemeriksaan', function ($row) {
                return Carbon::parse($row->tanggal_pemeriksaan)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('pemeriksa', function ($row) {
                return '<span>' . $row->pemeriksa_1 . '</span>' . ', ' . '<span>' . $row->pemeriksa_2 . '</span>' . ', ' . '<span>' . $row->pemeriksa_3 . '</span>' . ', ';
            })
            ->rawColumns(['aksi', 'pemeriksa'])
            ->make(true);
    }

    public function printPemeriksaan($id)
    {
        $pemeriksaanBarang = PemeriksaanBarang::find($id);

        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->where('id_barang_masuk', '=', $pemeriksaanBarang->barang_masuk_id)->first();

        $terbilang['tgl'] = Terbilang::make(Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('D'));
        $terbilang['tahun'] = Terbilang::make(Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('Y'));
        $pdf = Pdf::loadView('print.print-pemeriksaan', [
            'data' => $data,
            'pemeriksaanBarang' => $pemeriksaanBarang,
            'terbilang' => $terbilang,
        ]);

        return $pdf->stream();
    }

    public function printRekap(Request $request)
    {
        if ($request->semua) {
            $data = PemeriksaanBarang::with('barangMasuk')->get();
        } else {
            $data = PemeriksaanBarang::with('barangMasuk')->whereBetween('tanggal_pemeriksaan', [$request->dari_tanggal, $request->sampai_tanggal])->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-pemeriksaan', [
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
