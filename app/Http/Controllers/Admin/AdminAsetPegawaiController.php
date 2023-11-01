<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAsetPegawaiController extends Controller
{
    public function index()
    {
        return view('pages.admin.inventaris-ruangan.index',);
    }

    public function getData()
    {
        $data = Ruangan::with(['pegawai', 'aset'])->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('admin.inventaris-ruangan.detail', $row->id_ruangan);
                $hapusUrl = null;

                return view('modules.backend._formActionDetail', compact('detailUrl', 'hapusUrl'));
            })
            ->editColumn('pegawai', function ($row) {
                return $row->pegawai ? $row->pegawai->nama_pegawai : '-';
            })
            ->editColumn('jumlah_aset', function ($row) {
                return $row->aset->count();
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
