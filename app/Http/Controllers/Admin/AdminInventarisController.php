<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailSerahTerima;
use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\SerahTerima;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class AdminInventarisController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        return view('pages.admin.inventaris.index', [
            'ruangan' => $ruangan,
            'pegawai' => $pegawai
        ]);
    }

    public function getData(?string $filter)
    {
        if ($filter !== 'all') {
            $data = Inventaris::with(['barang', 'ruangan', 'pegawai'])->where('kondisi', '=', $filter)->latest();
        } else {
            $data = Inventaris::with(['barang', 'ruangan', 'pegawai'])->latest();
        }

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.inventaris.edit', $row->id_inventaris);
                $detailUrl = route('admin.inventaris.detail', md5($row->id_inventaris));

                return view('modules.backend._formActionEditAndDetail', compact('editUrl', 'detailUrl'));
            })
            ->editColumn('nama_barang', function ($row) {
                return $row->barang->nama_barang;
            })
            ->editColumn('kepemilikan', function ($row) {
                if ($row->jenis_kepemilikan !== null) {
                    if ($row->jenis_kepemilikan == 'ruangan') {
                        return $row->ruangan->nama_ruangan;
                    } elseif ($row->jenis_kepemilikan == 'pegawai') {
                        return $row->pegawai->nama_pegawai;
                    }
                } else {
                    return 'Bebas';
                }
            })
            ->editColumn('kode', function ($row) {
                return $row->barang->kode_barang . ' - ' . $row->register;
            })
            // ->editColumn('qr', function ($row) {
            //     return QrCode::size(150)->generate(route('inventaris-detail', md5($row->id_inventaris)));
            // })
            ->editColumn('kondisi', function ($row) {
                if ($row->kondisi == 'baik') {
                    return '<div class="badge badge-pill badge-success">Baik</div>';
                } elseif ($row->kondisi == 'cukup_baik') {
                    return '<div class="badge badge-pill badge-light">Cukup Baik</div>';
                } elseif ($row->kondisi == 'rusak') {
                    return '<div class="badge badge-pill badge-warning">Rusak</div>';
                } elseif ($row->kondisi == 'rusak_berat') {
                    return '<div class="badge badge-pill badge-danger">Rusak Berat</div>';
                }
            })
            ->rawColumns(['aksi', 'kondisi'])
            ->make(true);
    }

    public function printRekap(Request $request)
    {
        if ($request->kondisi == '') {
            $data = Inventaris::with(['barang', 'ruangan'])->get();
        } else {
            $data = Inventaris::with(['barang', 'ruangan'])->where('kondisi', '=', $request->kondisi)->get();
        }

        $pdf = Pdf::loadView('print.print-rekap-inventaris-semua', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        return view('pages.admin.inventaris.create');
    }

    public function store(Request $request)
    {
        $req = $this->validate($request, [
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'kondisi' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
        ]);

        $tahun_masuk = Carbon::now()->format('Y');
        foreach ($request->kode_barang as $key => $value) {
            $barang = Barang::where([
                ['kode_barang', $req['kode_barang'][$key]],
                ['nama_barang', $req['nama_barang'][$key]]
            ])->first();
            $jumlah_masuk = (int)$req['jumlah_masuk'][$key];
            $kondisi = $req['kondisi'][$key];
            for ($i = 1; $i <= $jumlah_masuk; $i++) {

                if ($lastData = Inventaris::join('tb_barang', 'tb_barang.id_barang', '=', 'tb_inventaris.barang_id')
                    ->where([
                        ['tb_barang.kode_barang', '=', $barang->kode_barang]
                    ])->orderBy('id_inventaris', 'DESC')->first()
                ) {
                    $no_register = $lastData->register + 1;
                } else {
                    $no_register = $i;
                }

                Inventaris::create([
                    'barang_id' => $barang->id_barang,
                    'register' => $no_register,
                    'kondisi' => $kondisi,
                    'tahun_masuk' => $tahun_masuk,
                ]);
            }
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.inventaris.index');
    }

    public function detail($id)
    {
        $data = Inventaris::where(DB::raw('md5(id_inventaris)'), $id)->with('ruangan')->first();
        if ($data->ruangan) {
            $pegawai = Pegawai::find($data->ruangan->pegawai_id);
        } else {
            $pegawai = null;
        }
        return view('pages.admin.inventaris.detail', [
            'data' => $data,
            'pegawai' => $pegawai
        ]);
    }

    public function edit($id)
    {
        $data = Inventaris::find($id);
        $ruangan = Ruangan::all();
        return view('pages.admin.inventaris.edit', [
            'data' => $data,
            'ruangan' => $ruangan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req = $request->validate([
            'kondisi' => 'required',
            'ruangan_id' => 'required',
        ]);

        Inventaris::find($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.inventaris.index');
    }

    public function distribusi(Request $request)
    {
        $request->validate([
            'jenis_kepemilikan' => 'required',
            'no_serah_terima' => 'required',
            'tanggal_serah_terima' => 'required',
            //---
            'barang_id' => 'required',
            'jumlah_tersedia' => 'required',
            'jumlah_distribusi' => 'required',
        ]);

        $allReq = $request->all();
        $req['jenis_kepemilikan'] = $allReq['jenis_kepemilikan'];
        $req['no_serah_terima'] = $allReq['no_serah_terima'];
        $req['tanggal_serah_terima'] = $allReq['tanggal_serah_terima'];
        $req['barang_id'] = $allReq['barang_id'];
        $req['jumlah_tersedia'] = $allReq['jumlah_tersedia'];
        $req['jumlah_distribusi'] = $allReq['jumlah_distribusi'];

        if ($req['jenis_kepemilikan'] == 'ruangan') {
            $request->validate([
                'ruangan_id' => 'required',
            ]);
            $req['ruangan_id'] = $allReq['ruangan_id'];
        } elseif ($req['jenis_kepemilikan'] == 'pegawai') {
            $request->validate([
                'pegawai_id' => 'required',
            ]);
            $req['pegawai_id'] = $allReq['pegawai_id'];
        }

        foreach ($request->barang_id as $key => $value) {
            if ($req['jumlah_distribusi'][$key] > $req['jumlah_tersedia'][$key]) {
                Alert::error('Gagal', 'Salah Satu Jumlah Distribusi Melebihi Jumlah Tersedia');
                return redirect()->back();
            }
        }

        // $st = SerahTerima::create([
        //     'no_serah_terima' => $req['no_serah_terima'],
        //     'tanggal_serah_terima' => $req['tanggal_serah_terima'],
        //     'ruangan_id' => $req['ruangan_id'],
        // ]);

        foreach ($request->barang_id as $key => $value) {

            $barangFree = Inventaris::where([
                ['barang_id', $req['barang_id'][$key]], ['ruangan_id', null], ['pegawai_id', null]
            ])->orderBy('register', 'ASC')->get();

            for ($i = 1; $i <= $req['jumlah_distribusi'][$key]; $i++) {
                if ($req['jenis_kepemilikan'] == 'ruangan') {
                    $barangFree->first()->update([
                        'ruangan_id' => $req['ruangan_id'],
                    ]);
                } elseif ($req['jenis_kepemilikan'] == 'pegawai') {
                    $barangFree->first()->update([
                        'pegawai_id' => $req['pegawai_id'],
                    ]);
                }
                $barangFree->first()->update([
                    'jenis_kepemilikan' => $req['jenis_kepemilikan'],
                ]);
                $barangFree->shift();
            }

            // DetailSerahTerima::create([
            //     'serah_terima_id' => $st->id_serah_terima,
            //     'barang_id' => $req['barang_id'][$key],
            //     'jumlah' => $req['jumlah_distribusi'][$key],
            // ]);
        }

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.inventaris.index');
    }
}
