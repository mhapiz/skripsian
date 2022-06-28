<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminBarangController extends Controller
{
    public function index()
    {
        return view('pages.admin.barang.index');
    }

    public function getData()
    {
        $data = Barang::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.barang.edit', $row->id_barang);
                $deleteUrl = route('admin.barang.destroy', $row->id_barang);

                return view('modules.backend._formActions', compact('editUrl', 'deleteUrl'));
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create()
    {
        return view('pages.admin.barang.create');
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'merk' => 'required',
            'foto_path' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $extension = $request->file('foto_path')->extension();
        $nama_foto = Str::slug($req['nama_barang']) . '-' . Str::slug($req['kode_barang']) . '-' . time() . '.' . $extension;

        Storage::putFileAs('public/barang', $request->file('foto_path'), $nama_foto);

        $req['foto_path'] = $nama_foto;

        Barang::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.barang.index');
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('pages.admin.barang.edit', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'merk' => 'required',
            'foto_path' => 'image|mimes:png,jpg,jpeg',
        ]);

        $barang = Barang::findOrFail($id);

        if ($request->file('foto_path')) {
            $extension = $request->file('foto_path')->extension();

            $nama_foto = Str::slug($req['nama_barang']) . '-' . Str::slug($req['kode_barang']) . '-' . time() . '.' . $extension;

            Storage::putFileAs('public/barang', $request->file('foto_path'), $nama_foto);

            Storage::delete('public/barang/' . $barang->foto_path);

            $req['foto_path'] = $nama_foto;
        } else {
            $req['foto_path'] = $barang->foto_path;
        }

        $barang->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.barang.index');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.barang.index');
    }
}
