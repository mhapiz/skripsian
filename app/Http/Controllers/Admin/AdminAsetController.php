<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Aset;
use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Inventaris;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdminAsetController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        return view('pages.admin.aset.index', [
            'pegawai' => $pegawai,
            'ruangan' => $ruangan
        ]);
    }

    public function getData(?string $filter)
    {
        if ($filter !== 'all') {
            $data = Aset::with(['ruangan', 'pegawai'])->where('kondisi', '=', $filter)->latest();
        } else {
            $data = Aset::with(['ruangan', 'pegawai'])->latest();
        }

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $detailUrl = route('admin.aset.detail', md5($row->id));

                return view('modules.backend._formActionDetail', compact('detailUrl'));
            })
            ->editColumn('kode', function ($row) {
                return $row->kode . ' - ' . $row->register;
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

    public function printRekap()
    {
        $data = Aset::get();
        $pdf = Pdf::loadView('print.print-rekap-aset-semua', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function createKendaraanDinas()
    {
        return view('pages.admin.aset.createKendaraanDinas');
    }

    public function createAset()
    {
        return view('pages.admin.aset.createAset');
    }

    public function store(Request $request)
    {
        $jenis = $request->jenis;
        $rules = [
            'foto_path.*' => 'required',
            'nama.*' => 'required',
            'kode.*' => 'required',
            'merk.*' => 'required',
            'keterangan.*' => 'nullable',
            'kondisi.*' => 'required',
            'jumlah_masuk.*' => 'required',
            'harga_satuan.*' => 'required',
        ];

        if ($jenis === Aset::KENDARAAN_DINAS) {
            $rules['no_bpkb.*'] = 'required';
            $rules['no_polisi.*'] = 'required';
            $rules['no_rangka.*'] = 'required';
            $rules['no_mesin.*'] = 'required';
        }

        try {
            $req = $this->validate($request, $rules);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors(['validation' => 'Harap isi semua kolom dengan benar'])
                ->withInput();
        }

        $tahun_masuk = Carbon::now()->format('Y');

        foreach ($req['kode'] as $key => $kode) {
            $nama = $req['nama'][$key];
            $merk = $req['merk'][$key];
            $foto_path = $req['foto_path'][$key];
            $keterangan = $req['keterangan'][$key];
            $kondisi = $req['kondisi'][$key];
            $jumlah_masuk = (int)$req['jumlah_masuk'][$key];

            if ($jenis === Aset::KENDARAAN_DINAS) {
                $no_bpkb = $req['no_bpkb'][$key];
                $no_polisi = $req['no_polisi'][$key];
                $no_rangka = $req['no_rangka'][$key];
                $no_mesin = $req['no_mesin'][$key];
            }

            $chekAsetKondisi = [
                ['nama', '=', $nama],
                ['kode', '=', $kode],
                ['merk', '=', $merk],
                ['kondisi', '=', $kondisi],
            ];

            if ($jenis === Aset::KENDARAAN_DINAS) {
                $chekAsetKondisi[] = ['no_bpkb', '=', $no_bpkb];
                $chekAsetKondisi[] = ['no_polisi', '=', $no_polisi];
                $chekAsetKondisi[] = ['no_rangka', '=', $no_rangka];
                $chekAsetKondisi[] = ['no_mesin', '=', $no_mesin];
            }

            $aset = Aset::where($chekAsetKondisi)->orderBy('id', 'DESC')->first();

            if ($aset == null) {
                $extension = $foto_path->extension();
                $nama_foto = Str::slug($nama) . '-' . Str::slug($kode) . '-' . time() . '.' . $extension;

                Storage::putFileAs('public/barang', $foto_path, $nama_foto);
                $foto_path = $nama_foto;

            } else {
                $foto_path = $aset->foto_path;
            }

            unset($chekAsetKondisi[3]);
            $registerCheck = Aset::where($chekAsetKondisi)->orderBy('id', 'DESC')->first();
            $no_register = $registerCheck ? $registerCheck->register + 1 : 1;

            for ($i = 1; $i <= $jumlah_masuk; $i++) {
                $asetData = [
                    'foto_path' => $foto_path,
                    'nama' => $nama,
                    'kode' => $kode,
                    'merk' => $merk,
                    'keterangan' => $keterangan,
                    'jenis' => $jenis,
                    'register' => $no_register++,
                    'kondisi' => $kondisi,
                    'tahun_masuk' => $tahun_masuk,
                ];

                if ($jenis === ASET::KENDARAAN_DINAS) {
                    $asetData['no_bpkb'] = $no_bpkb;
                    $asetData['no_polisi'] = $no_polisi;
                    $asetData['no_rangka'] = $no_rangka;
                    $asetData['no_mesin'] = $no_mesin;
                }

                Aset::create($asetData);
            }

        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.aset.index');
    }

    public function detail($id)
    {
        $data = Aset::where(DB::raw('md5(id)'), $id)->first();

        return view('pages.admin.aset.detail', [
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $data = Aset::find($id);
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        return view('pages.admin.aset.edit', [
            'data' => $data,
            'ruangan' => $ruangan,
            'pegawai' => $pegawai
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required',
            'jenis_kepemilikan' => 'required'
        ]);

        $allReq = $request->all();
        $req['jenis_kepemilikan'] = $allReq['jenis_kepemilikan'];

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

        Aset::find($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.aset.index');
    }

}
