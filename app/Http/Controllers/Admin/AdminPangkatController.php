<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminPangkatController extends Controller
{
    public function index()
    {
        return view('pages.admin.pangkat.index');
    }

    public function getData()
    {
        $data = Pangkat::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.pangkat.edit', $row->id_pangkat);
                $deleteUrl = route('admin.pangkat.destroy', $row->id_pangkat);

                return view('modules.backend._formActions', compact('editUrl', 'deleteUrl'));
            })
            ->editColumn('gaji_pokok', function ($row) {
                return 'Rp. ' . number_format($row->gaji_pokok, 0, ',', '.');
            })
            ->editColumn('potongan', function ($row) {
                return $row->potongan . '%';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        return view('pages.admin.pangkat.create', []);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'nama_pangkat' => 'required',
            'golongan' => 'required',
            'gaji_pokok' => 'required',
            'potongan' => 'required',
        ]);

        Pangkat::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.pangkat.index');
    }

    public function edit($id)
    {
        $data = Pangkat::findOrFail($id);
        return view('pages.admin.pangkat.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'nama_pangkat' => 'required',
            'golongan' => 'required',
            'gaji_pokok' => 'required',
            'potongan' => 'required',
        ]);

        Pangkat::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.pangkat.index');
    }

    public function destroy($id)
    {
        Pangkat::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.pangkat.index');
    }
}
