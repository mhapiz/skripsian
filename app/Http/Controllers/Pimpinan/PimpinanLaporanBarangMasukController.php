<?php

namespace App\Http\Controllers\Pimpinan;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PimpinanLaporanBarangMasukController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.laporan-barang-masuk.index');
    }

    public function getData(Request $request)
    {
        if (!empty($request->bulan) && !empty($request->tahun)) {
            $data = BarangMasuk::selectRaw('year(tanggal) as year, month(tanggal) as month, sum(total_harga) as total_belanja ')
                ->groupBy('year', 'month')
                ->whereMonth('tanggal', '=',  $request->bulan)
                ->whereYear('tanggal', '=', $request->tahun)
                ->orderByRaw('min(created_at) desc');
        } else {
            $data = BarangMasuk::selectRaw('year(tanggal) as year, month(tanggal) as month, sum(total_harga) as total_belanja ')
                ->groupBy('year', 'month')
                ->orderByRaw('min(created_at) desc');
        }

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('total_belanja', function ($row) {
                return 'Rp. ' . number_format($row->total_belanja, 0, ',', '.');
            })
            ->editColumn('month', function ($row) {
                switch ($row->month) {
                    case '1':
                        return 'Januari';
                        break;
                    case '2':
                        return 'Februari';
                        break;
                    case '3':
                        return 'Maret';
                        break;
                    case '4':
                        return 'April';
                        break;
                    case '5':
                        return 'Mei';
                        break;
                    case '6':
                        return 'Juni';
                        break;
                    case '7':
                        return 'Juli';
                        break;
                    case '8':
                        return 'Agustus';
                        break;
                    case '9':
                        return 'September';
                        break;
                    case '10':
                        return 'Oktober';
                        break;
                    case '11':
                        return 'November';
                        break;
                    case '12':
                        return 'Desember';
                        break;

                    default:
                        return $row->month;
                        break;
                }
            })
            ->rawColumns([''])
            ->make(true);
    }

    public function printRekap(Request $request)
    {
        if ($request->tahun) {
            $data = BarangMasuk::selectRaw('year(tanggal) as year, month(tanggal) as month, sum(total_harga) as total_belanja ')
                ->groupBy('year', 'month')
                ->whereYear('tanggal', '=', $request->tahun)
                ->orderByRaw('min(created_at) asc')->get();
        } else {
            $data = BarangMasuk::selectRaw('year(tanggal) as year, month(tanggal) as month, sum(total_harga) as total_belanja ')
                ->groupBy('year', 'month')
                ->orderByRaw('min(created_at) asc')->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-laporan-barang-masuk', [
            'data' => $data,
            'tahun' => $request->tahun,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
