<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminRuanganController extends Controller
{
    public function index()
    {
        return view('pages.admin.ruangan.index');
    }

    public function getData()
    {
        $data = Ruangan::with('pegawai')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.ruangan.edit', $row->id_ruangan);
                $detailUrl = route('admin.ruangan.detail', $row->id_ruangan);
                $deleteUrl = route('admin.ruangan.destroy', $row->id_ruangan);

                return view('modules.backend._formActionsWithDetail', compact('editUrl', 'deleteUrl', 'detailUrl'));
            })
            ->editColumn('pegawai', function ($row) {
                return $row->pegawai->nama_pegawai;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function printDetail($id)
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-ruangan', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function detail($id)
    {
        $data = Ruangan::with(['pegawai', 'inventaris'])->findOrFail($id);

        return view('pages.admin.ruangan.detail', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        return view('pages.admin.ruangan.create', [
            'pegawai' => $pegawai
        ]);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'nama_ruangan' => 'required',
            'pegawai_id' => 'required',
        ]);

        Ruangan::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.ruangan.index');
    }

    public function edit($id)
    {
        $data = Ruangan::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('pages.admin.ruangan.edit', [
            'data' => $data,
            'pegawai' => $pegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'nama_ruangan' => 'required',
            'pegawai_id' => 'required',
        ]);

        Ruangan::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.ruangan.index');
    }

    public function destroy($id)
    {
        Ruangan::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.ruangan.index');
    }
}
