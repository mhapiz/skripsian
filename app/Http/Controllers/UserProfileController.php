<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfileController extends Controller
{
    public function index()
    {
        $data = User::findOrFail(Auth::user()->id_user);
        return view('pages.profil.index', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $req = $request->validate([
            'username' => 'required|unique:tb_user,username,' . $id . ',id_user',
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
                'password' => Hash::make($request->password),
            ]);
        } else {
            $data->update([
                'username' => $req['username'],
            ]);
        }

        Alert::success('Data berhasil diubah');
        return redirect()->route('my-profile');
    }
}
