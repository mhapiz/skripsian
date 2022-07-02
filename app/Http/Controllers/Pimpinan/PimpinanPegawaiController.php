<?php

namespace App\Http\Controllers\Pimpinan;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PimpinanPegawaiController extends Controller
{
    public function index()
    {
        return view('pages.pimpinan.pegawai.index');
    }

    public function getData()
    {
        $data = Pegawai::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('pangkat', function ($row) {
                return $row->pangkat->nama_pangkat . '-' . $row->pangkat->golongan;
            })
            ->rawColumns([''])
            ->make(true);
    }

    public function printRekap()
    {
        $data = Pegawai::with('pangkat')->get();
        $pdf = Pdf::loadView('print.print-rekap-pegawai-semua', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
