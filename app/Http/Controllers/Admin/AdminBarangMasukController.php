<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Inventaris;
use App\Models\PemeriksaanBarang;
use App\Models\Suplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminBarangMasukController extends Controller
{
    public function index()
    {
        return view('pages.admin.barang-masuk.index');
    }

    public function getData()
    {
        $data = BarangMasuk::with('suplier')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.barang-masuk.edit', $row->id_barang_masuk);
                $detailUrl = route('admin.barang-masuk.detail', $row->id_barang_masuk);
                $deleteUrl = route('admin.barang-masuk.destroy', $row->id_barang_masuk);

                return view('modules.backend._formActionsWithDetail', compact('editUrl', 'deleteUrl', 'detailUrl'));
            })
            ->editColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');
            })
            ->editColumn('total_harga', function ($row) {
                return 'Rp. ' . number_format($row->total_harga, 0, ',', '.');
            })
            ->editColumn('suplier', function ($row) {
                return $row->suplier->nama_suplier;
            })
            ->editColumn('aksiLain', function ($row) {
                if ($row->addedToInventaris) {
                    $url = route('admin.barang-masuk.printPemeriksaan', $row->id_barang_masuk);
                    $status = 'added';
                } else {
                    $url = route('admin.barang-masuk.addToInventaris', $row->id_barang_masuk);
                    $status = 'no';
                }
                return view('modules.backend._formActionCetak', [
                    'url' => $url,
                    'status' => $status,
                ]);
            })
            ->rawColumns(['aksi', 'aksiLain'])
            ->make(true);
    }

    public function detail($id)
    {
        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->findOrFail($id);


        return view('pages.admin.barang-masuk.detail', [
            'data' => $data
        ]);
    }

    public function printPemeriksaan($id)
    {
        $pemeriksaanBarang = PemeriksaanBarang::where('barang_masuk_id', $id)->first();

        if ($pemeriksaanBarang == null) {
            Alert::info('Harap Isi Detail Pemeriksaan');
            Session::put('barang_masuk_id', $id);
            return redirect()->route('admin.pemeriksaan-barang.create');
        } else {

            return redirect()->route('admin.pemeriksaan-barang.printPemeriksaan', $pemeriksaanBarang->id_pemeriksaan_barang);
        }
    }

    public function printRekap()
    {
        $data = BarangMasuk::with(['suplier'])->get();

        $pdf = Pdf::loadView('print.print-rekap-barang-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printDetail($id)
    {
        $data = BarangMasuk::with(['suplier', 'detail_barang_masuk'])->findOrFail($id);

        $pdf = Pdf::loadView('print.print-detail-barang-masuk', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function addToInventaris($id)
    {
        $data = BarangMasuk::findOrFail($id);
        $detail = DetailBarangMasuk::with('barang')->where('barang_masuk_id', $id)->get();

        $tahun_masuk = Carbon::parse($data->tanggal)->year;

        foreach ($detail as $d) {

            for ($i = 1; $i <= $d->jumlah_masuk; $i++) {

                if ($lastData = Inventaris::join('tb_barang', 'tb_barang.id_barang', '=', 'tb_inventaris.barang_id')
                    ->where([
                        ['tb_barang.kode_barang', '=', $d->barang->kode_barang]
                    ])->orderBy('id_inventaris', 'DESC')->first()
                ) {
                    $no_register = $lastData->register + 1;
                } else {
                    $no_register = $i;
                }

                Inventaris::create([
                    'barang_id' => $d->barang_id,
                    'register' => $no_register,
                    'kondisi' => 'baik',
                    'tahun_masuk' => $tahun_masuk,
                ]);
            }
        }

        $data->update([
            'addedToInventaris' => true
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan ke inventaris');
        return redirect()->route('admin.barang-masuk.index');
    }

    public function create()
    {
        $suplier = Suplier::all();
        return view('pages.admin.barang-masuk.create', [
            'suplier' => $suplier
        ]);
    }

    public function store(Request $request)
    {
        $req = $this->validate($request, [
            'tanggal' => 'required',
            'suplier_id' => 'required',
            //---
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
        ]);

        $bm = BarangMasuk::create([
            'tanggal' => $req['tanggal'],
            'suplier_id' => $req['suplier_id'],
        ]);

        $total_harga = 0;
        foreach ($request->kode_barang as $key => $value) {
            DetailBarangMasuk::create([
                'barang_masuk_id' => $bm->id_barang_masuk,
                'barang_id' => Barang::where([
                    ['kode_barang', $req['kode_barang'][$key]],
                    ['nama_barang', $req['nama_barang'][$key]]
                ])->first()->id_barang,
                'jumlah_masuk' => $req['jumlah_masuk'][$key],
                'harga_satuan' => $req['harga_satuan'][$key],
            ]);
            $total_harga = $total_harga + ($req['jumlah_masuk'][$key] * $req['harga_satuan'][$key]);
        }

        $bm->update([
            'total_harga' => $total_harga
        ]);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.barang-masuk.index');
    }

    public function edit($id)
    {
        $data = BarangMasuk::with(['detail_barang_masuk'])->find($id);

        if ($data->addedToInventaris) {
            Alert::error('Gagal', 'Data sudah ditambahkan ke inventaris');
            return redirect()->route('admin.barang-masuk.index');
        }

        return view('pages.admin.barang-masuk.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $this->validate($request, [
            'tanggal' => 'required',
            'suplier_id' => 'required',
            //---
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
        ]);

        $bm = BarangMasuk::find($id);
        $bm->update([
            'tanggal' => $req['tanggal'],
            'suplier_id' => $req['suplier_id'],
        ]);

        $detal_bm = DetailBarangMasuk::where('barang_masuk_id', $id)->get();

        foreach ($detal_bm as $key => $value) {
            $value->delete();
        }

        $total_harga = 0;
        foreach ($request->kode_barang as $key => $value) {
            DetailBarangMasuk::create([
                'barang_masuk_id' => $bm->id_barang_masuk,
                'barang_id' => Barang::where([
                    ['kode_barang', $req['kode_barang'][$key]],
                    ['nama_barang', $req['nama_barang'][$key]]
                ])->first()->id_barang,
                'jumlah_masuk' => $req['jumlah_masuk'][$key],
                'harga_satuan' => $req['harga_satuan'][$key],
            ]);
            $total_harga = $total_harga + ($req['jumlah_masuk'][$key] * $req['harga_satuan'][$key]);
        }

        $bm->update([
            'total_harga' => $total_harga
        ]);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.barang-masuk.index');
    }

    public function destroy($id)
    {
        $bm = BarangMasuk::find($id);
        if ($bm->addedToInventaris) {
            Alert::error('Gagal', 'Data sudah ditambahkan ke inventaris');
            return redirect()->route('admin.barang-masuk.index');
        }
        $detal_bm = DetailBarangMasuk::where('barang_masuk_id', $id)->get();

        foreach ($detal_bm as $value) {
            $value->delete();
        }

        $bm->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.barang-masuk.index');
    }
}
