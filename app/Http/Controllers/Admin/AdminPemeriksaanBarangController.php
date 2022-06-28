<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\PemeriksaanBarang;
use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Riskihajar\Terbilang\Facades\Terbilang;
use Yajra\DataTables\Facades\DataTables;

class AdminPemeriksaanBarangController extends Controller
{
    public function index()
    {
        return view('pages.admin.pemeriksaan-barang.index');
    }

    public function getData()
    {
        $data = PemeriksaanBarang::latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.pemeriksaan-barang.edit', $row->id_pemeriksaan_barang);
                $printUrl = route('admin.pemeriksaan-barang.printPemeriksaan', $row->id_pemeriksaan_barang);
                $deleteUrl = route('admin.pemeriksaan-barang.destroy', $row->id_pemeriksaan_barang);

                return view('modules.backend._formActionsWithPrint', compact('editUrl', 'deleteUrl', 'printUrl'));
            })
            ->editColumn('tanggal_pemeriksaan', function ($row) {
                return Carbon::parse($row->tanggal_pemeriksaan)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('pemeriksa', function ($row) {
                return '<span>' . $row->pemeriksa_1 . '</span>' . ', ' . '<span>' . $row->pemeriksa_2 . '</span>' . ', ' . '<span>' . $row->pemeriksa_3 . '</span>' . ', ';
            })
            ->rawColumns(['aksi', 'pemeriksa'])
            ->make(true);
    }

    public function printPemeriksaan($id)
    {
        $pemeriksaanBarang = PemeriksaanBarang::find($id);

        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->where('id_barang_masuk', '=', $pemeriksaanBarang->barang_masuk_id)->first();

        $terbilang['tgl'] = Terbilang::make(Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('D'));
        $terbilang['tahun'] = Terbilang::make(Carbon::parse($pemeriksaanBarang->tanggal_pemeriksaan)->isoFormat('Y'));
        $pdf = Pdf::loadView('print.print-pemeriksaan', [
            'data' => $data,
            'pemeriksaanBarang' => $pemeriksaanBarang,
            'terbilang' => $terbilang,
        ]);

        return $pdf->stream();
    }

    public function printRekap()
    {
        $data = PemeriksaanBarang::with('barangMasuk')->get();
        $pdf = Pdf::loadView('print.print-rekap-pemeriksaan', [
            'data' => $data,
        ]);

        return $pdf->stream();
    }

    public function create()
    {
        $pemeriksaanBarang = PemeriksaanBarang::pluck('barang_masuk_id')->all();
        $barang_masuk = BarangMasuk::whereNotIn('id_barang_masuk', $pemeriksaanBarang)->where('addedToInventaris', '=', 1)->select(['id_barang_masuk', 'tanggal', 'suplier_id', 'total_harga'])->with('suplier')->get();
        $pegawai = Pegawai::all();
        return view('pages.admin.pemeriksaan-barang.create', [
            'barang_masuk' => $barang_masuk,
            'pegawai' => $pegawai,
        ]);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'no_pemeriksaan' => 'required',
            'tanggal_pemeriksaan' => 'required',
            'barang_masuk_id' => 'required',
            'pemeriksa_1' => 'required',
            'pemeriksa_2' => 'required',
            'pemeriksa_3' => 'required',
        ]);

        PemeriksaanBarang::create($req);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.pemeriksaan-barang.index');
    }

    public function edit($id)
    {
        $data = PemeriksaanBarang::findOrFail($id);
        $barang_masuk = BarangMasuk::with('suplier')->get();
        $pegawai = Pegawai::all();

        return view('pages.admin.pemeriksaan-barang.edit', [
            'data' => $data,
            'pegawai' => $pegawai,
            'barang_masuk' => $barang_masuk
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'no_pemeriksaan' => 'required',
            'tanggal_pemeriksaan' => 'required',
            'barang_masuk_id' => 'required',
            'pemeriksa_1' => 'required',
            'pemeriksa_2' => 'required',
            'pemeriksa_3' => 'required',
        ]);

        PemeriksaanBarang::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.pemeriksaan-barang.index');
    }

    public function destroy($id)
    {
        PemeriksaanBarang::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.pemeriksaan-barang.index');
    }
}
