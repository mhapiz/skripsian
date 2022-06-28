<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminAsetController extends Controller
{
    public function index()
    {
        return view('pages.admin.aset.index');
    }

    public function getData()
    {
        $data = Aset::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('admin.aset.detail', md5($row->id_aset));

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('kode', function ($row) {
                return $row->kode_aset . ' - ' . $row->register;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function printRekap()
    {
        $data = Aset::get();
        $pdf = Pdf::loadView('print.print-rekap-aset-semua', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function detail($id)
    {
        $data = Aset::where(DB::raw('md5(id_aset)'), $id)->first();

        return view('pages.admin.aset.detail', [
            'data' => $data
        ]);
    }
}
