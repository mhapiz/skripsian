<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\Suplier;
use App\Models\AsetMasuk;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use App\Models\DetailAsetMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PemeriksaanBarang;
use App\Http\Controllers\Controller;
use App\Models\Aset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminAsetMasukController extends Controller
{
    public function index()
    {
        return view('pages.admin.aset-masuk.index');
    }

    public function getData()
    {
        $data = AsetMasuk::with('suplier')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('admin.aset-masuk.detail', $row->id_aset_masuk);

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('suplier', function ($row) {
                return $row->suplier->nama_suplier;
            })
            ->editColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('total_harga', function ($row) {
                return 'Rp ' . number_format($row->total_harga, 0, ',', '.');
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = AsetMasuk::with(['suplier', 'detail_aset_masuk'])->findOrFail($id);

        return view('pages.admin.aset-masuk.detail', [
            'data' => $data
        ]);
    }

    public function printPemeriksaan($id)
    {
        return redirect()->route('admin.aset-masuk.printDetail', $id);
    }

    public function printRekap()
    {
        $data = AsetMasuk::with(['suplier'])->get();

        $pdf = Pdf::loadView('print.print-rekap-aset-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printDetail($id)
    {
        $data = AsetMasuk::with(['suplier', 'detail_aset_masuk'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-aset-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        $suplier = Suplier::all();
        return view('pages.admin.aset-masuk.create', [
            'suplier' => $suplier
        ]);
    }

    public function store(Request $request)
    {
        $req = $this->validate($request, [
            'nomor' => 'required',
            'tanggal' => 'required',
            'suplier_id' => '',
            //---
            'nama_aset' => 'required',
            'kode_aset' => 'required',
            'keterangan' => 'required',
            'kondisi' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
        ]);

        $tahun = Carbon::parse($req['tanggal'])->year;

        $am = AsetMasuk::create([
            'nomor' => $req['nomor'],
            'tanggal' => $req['tanggal'],
            'suplier_id' => $req['suplier_id'],
            'total_harga' => '0',
        ]);

        $total_harga = 0;
        foreach ($request->kode_aset as $key => $value) {

            for ($i = 1; $i <= $request->jumlah_masuk[$key]; $i++) {
                if ($lastData = Aset::where('kode_aset', '=', $request->kode_aset[$key])->orderBy('id_aset', 'DESC')->first()) {
                    $register = $lastData->register + 1;
                } else {
                    $register = 1;
                }
                Aset::create([
                    'nama_aset' => $req['nama_aset'][$key],
                    'kode_aset' => $req['kode_aset'][$key],
                    'keterangan' => $req['keterangan'][$key],
                    'register' => $register,
                    'kondisi' => $req['kondisi'][$key],
                    'harga_beli' => $req['harga_satuan'][$key],
                    'tahun_masuk' => $tahun,
                ]);
            }

            DetailAsetMasuk::create([
                'aset_masuk_id' => $am->id_aset_masuk,
                'nama_aset' => $req['nama_aset'][$key],
                'kode_aset' => $req['kode_aset'][$key],
                'jumlah_masuk' => $req['jumlah_masuk'][$key],
                'harga_satuan' => $req['harga_satuan'][$key],
            ]);
            $total_harga = $total_harga + ($req['jumlah_masuk'][$key] * $req['harga_satuan'][$key]);
        }

        $am->update([
            'total_harga' => $total_harga
        ]);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.aset-masuk.index');
    }

    public function edit($id)
    {
        $data = AsetMasuk::with(['detail_aset_masuk'])->find($id);

        if ($data->addedToInventaris) {
            Alert::error('Gagal', 'Data sudah ditambahkan ke inventaris');
            return redirect()->route('admin.aset-masuk.index');
        }

        return view('pages.admin.aset-masuk.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $this->validate($request, [
            'tanggal' => 'required',
            'suplier_id' => '',
            //---
            'kode_barang' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
        ]);

        $bm = AsetMasuk::find($id);
        $bm->update([
            'tanggal' => $req['tanggal'],
            'suplier_id' => $req['suplier_id'],
        ]);

        $detal_bm = DetailAsetMasuk::where('barang_masuk_id', $id)->get();

        foreach ($detal_bm as $key => $value) {
            $value->delete();
        }

        $total_harga = 0;
        foreach ($request->kode_barang as $key => $value) {
            DetailAsetMasuk::create([
                'barang_masuk_id' => $bm->id_aset_masuk,
                'barang_id' => Barang::where('kode_barang', $req['kode_barang'][$key])->first()->id_barang,
                'jumlah_masuk' => $req['jumlah_masuk'][$key],
                'harga_satuan' => $req['harga_satuan'][$key],
            ]);
            $total_harga = $total_harga + ($req['jumlah_masuk'][$key] * $req['harga_satuan'][$key]);
        }

        $bm->update([
            'total_harga' => $total_harga
        ]);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.aset-masuk.index');
    }

    public function destroy($id)
    {
        $bm = AsetMasuk::find($id);
        if ($bm->addedToInventaris) {
            Alert::error('Gagal', 'Data sudah ditambahkan ke inventaris');
            return redirect()->route('admin.aset-masuk.index');
        }
        $detal_bm = DetailAsetMasuk::where('barang_masuk_id', $id)->get();

        foreach ($detal_bm as $value) {
            $value->delete();
        }

        $bm->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.aset-masuk.index');
    }
}
