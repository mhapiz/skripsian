<?php

namespace App\Http\Controllers\Pimpinan;

use App\Models\Pangkat;
use App\Models\GajiPegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Riskihajar\Terbilang\Facades\Terbilang;

class PimpinanGajiPegawaiController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.gaji-pegawai.index');
    }

    public function getData()
    {
        $data = GajiPegawai::with('pegawai')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('nama_pegawai', function ($row) {
                return $row->pegawai->nama_pegawai;
            })
            ->editColumn('bulan', function ($row) {
                switch ($row->bulan) {
                    case '01':
                        $bulan = 'Januari';
                        break;
                    case '02':
                        $bulan = 'Februari';
                        break;
                    case '03':
                        $bulan = 'Maret';
                        break;
                    case '04':
                        $bulan = 'April';
                        break;
                    case '05':
                        $bulan = 'Mei';
                        break;
                    case '06':
                        $bulan = 'Juni';
                        break;
                    case '07':
                        $bulan = 'Juli';
                        break;
                    case '08':
                        $bulan = 'Agustus';
                        break;
                    case '09':
                        $bulan = 'September';
                        break;
                    case '10':
                        $bulan = 'Oktober';
                        break;
                    case '11':
                        $bulan = 'November';
                        break;
                    case '12':
                        $bulan = 'Desember';
                        break;
                    default:
                        $row->bulan;
                        break;
                }
                return $bulan . ' ' . $row->tahun;
            })
            ->editColumn('total_gaji', function ($row) {
                return 'Rp. ' . number_format($row->total_gaji, 0, ',', '.');
            })
            ->rawColumns([''])
            ->make(true);
    }

    public function printDetail($id)
    {
        $data = GajiPegawai::with('pegawai')->findOrFail($id);

        $pangkat = Pangkat::find($data->pegawai->pangkat_id);

        $data['gaji_terbilang'] = Terbilang::make($data->total_gaji);

        $pdf = Pdf::loadView('print.print-detail-gaji-pegawai', [
            'data' => $data,
            'pangkat' => $pangkat,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printRekap()
    {
        $data = GajiPegawai::with('pegawai')->get();

        $pdf = Pdf::loadView('print.print-rekap-gaji-pegawai', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
