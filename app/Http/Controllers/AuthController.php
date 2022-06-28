<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'username wajib diisi!',
            'password.required' => 'kata sandi wajib diisi!'
        ]);


        Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            Alert::success('Berhasil Login!', 'Selamat Datang!');
            //check role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }
        } else { // false
            Alert::toast('Gagal Login!', 'error');
            return redirect()->route('login.view');
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login.view');
    }
}
