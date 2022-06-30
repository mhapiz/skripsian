<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminPegawaiController extends Controller
{
    public function index()
    {

        return view('pages.admin.pegawai.index');
    }

    public function getData()
    {
        $data = Pegawai::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.pegawai.edit', $row->id_pegawai);
                $deleteUrl = route('admin.pegawai.destroy', $row->id_pegawai);

                return view('modules.backend._formActionsWithPrint', compact('editUrl', 'deleteUrl'));
            })
            ->editColumn('pangkat', function ($row) {
                return $row->pangkat->nama_pangkat . '-' . $row->pangkat->golongan;
            })
            ->rawColumns(['aksi'])
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
    public function create()
    {
        $pangkat = Pangkat::all();
        return view('pages.admin.pegawai.create', [
            'pangkat' => $pangkat
        ]);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'pangkat_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Pegawai::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.pegawai.index');
    }

    public function edit($id)
    {
        $pangkat = Pangkat::all();
        $data = Pegawai::findOrFail($id);
        return view('pages.admin.pegawai.edit', [
            'data' => $data,
            'pangkat' => $pangkat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'pangkat_id' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Pegawai::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.pegawai.index');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.pegawai.index');
    }
}
