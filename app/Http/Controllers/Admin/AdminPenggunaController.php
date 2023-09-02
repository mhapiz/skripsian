<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminPenggunaController extends Controller
{
    public function index()
    {
        return view('pages.admin.pengguna.index');
    }

    public function getData()
    {
        $data = User::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.pengguna.edit', $row->id_user);
                $deleteUrl = route('admin.pengguna.destroy', $row->id_user);

                return view('modules.backend._formActions', compact('editUrl', 'deleteUrl'));
            })
            ->editColumn('role', function ($row) {
                if ($row->role == 'admin') {
                    return 'Admin';
                } elseif ($row->role == 'pimpinan') {
                    return 'Pimpinan';
                }
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('pages.admin.pengguna.create', [
        ]);
    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'username' => 'required|unique:tb_user',
            'role' => 'required',
            'password' => 'required|min:6|required_with:password_repeat|same:password_repeat',
            'password_repeat' => 'required',
        ]);

        if ($req['password'] != $req['password_repeat']) {
            Alert::toast('Password tidak sama', 'error');
            return redirect()->back();
        }

        User::create([
            'username' => $req['username'],
            'role' => $req['role'],
            'password' => Hash::make($req['password']),
        ]);


        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.pengguna.index');
    }

    public function edit($id)
    {
        // if ($id == Auth::user()->id_user) {
        //     return redirect()->route('profil.view');
        // }
        $data = User::findOrFail($id);
        return view('pages.admin.pengguna.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $req = $request->validate([
            'username' => 'required|unique:tb_user,username,' . $id . ',id_user',
            'role' => 'required',
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|min:6|required_with:password_repeat|same:password_repeat',
                'password_repeat' => 'required',
            ]);

            if ($request->password != $request->password_repeat) {
                Alert::toast('Password tidak sama', 'error');
                return redirect()->back();
            }
        }

        if ($request->password != null) {
            $data->update([
                'username' => $req['username'],
                'role' => $req['role'],
                'password' => Hash::make($request->password),
            ]);
        } else {
            $data->update([
                'username' => $req['username'],
                'role' => $req['role'],
            ]);
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.pengguna.index');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data->id_user == Auth::user()->id_user) {
            Alert::info('Anda tidak bisa menghapus akun anda sendiri');
            return redirect()->back();
        }

        $data->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.pengguna.index');
    }
}
