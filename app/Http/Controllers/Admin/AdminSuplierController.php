<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use App\Models\Suplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminSuplierController extends Controller
{
    public function index()
    {

        return view('pages.admin.suplier.index');
    }

    public function getData()
    {
        $data = Suplier::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.suplier.edit', $row->id_suplier);
                $deleteUrl = route('admin.suplier.destroy', $row->id_suplier);

                return view('modules.backend._formActions', compact('editUrl', 'deleteUrl'));
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        $pegawai = Pegawai::all();
        return view('pages.admin.suplier.create', [
            'pegawai' => $pegawai
        ]);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'nama_suplier' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        Suplier::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.suplier.index');
    }

    public function edit($id)
    {
        $data = Suplier::findOrFail($id);
        return view('pages.admin.suplier.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'nama_suplier' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        Suplier::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.suplier.index');
    }

    public function destroy($id)
    {
        Suplier::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.suplier.index');
    }
}
