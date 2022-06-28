<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminInventarisRuanganController extends Controller
{
    public function index()
    {
        return view('pages.admin.inventaris-ruangan.index',);
    }

    public function getData()
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('admin.inventaris-ruangan.detail', $row->id_ruangan);

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('pegawai', function ($row) {
                return $row->pegawai->nama_pegawai;
            })
            ->editColumn('jumlah_barang_inventaris', function ($row) {
                return $row->inventaris->count();
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function printRekap()
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->latest()->get();
        $pdf = Pdf::loadView('print.print-rekap-inventaris-ruangan', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function detail($id)
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->findOrFail($id);

        return view('pages.admin.inventaris-ruangan.detail', [
            'data' => $data
        ]);
    }

    public function printDetail($id)
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-ruangan', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
