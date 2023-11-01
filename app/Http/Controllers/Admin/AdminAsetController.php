<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KartuInventarisRuanganExport;
use App\Exports\LaporanInventarisBarangExport;
use Carbon\Carbon;
use App\Models\Aset;
use App\Models\Pegawai;
use App\Models\Ruangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class AdminAsetController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        $uniqueAset = Aset::getUniqueAssets();
        return view('pages.admin.aset.index', [
            'pegawai' => $pegawai,
            'ruangan' => $ruangan,
            'uniqueAset' => $uniqueAset
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
                $hapusUrl = route('admin.aset.hapus', md5($row->id));

                return view('modules.backend._formActionDetail', compact('detailUrl', 'hapusUrl'));
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
            'tahun.*' => 'required',
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

        foreach ($req['kode'] as $key => $kode) {
            $nama = $req['nama'][$key];
            $merk = $req['merk'][$key];
            $foto_path = $req['foto_path'][$key];
            $keterangan = $req['keterangan'][$key];
            $kondisi = $req['kondisi'][$key];
            $jumlah_masuk = (int) $req['jumlah_masuk'][$key];
            $tahun = $req['tahun'][$key];
            $harga_satuan = $req['harga_satuan'][$key];

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

                $w = Image::make($foto_path)->width();
                $w -= $w * 50 / 100;

                $resizeFoto = Image::make($foto_path->path());

                $resizeFoto->resize($w, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();

                Storage::put($nama_foto, $resizeFoto);

                Storage::move($nama_foto, 'public/barang/' . $nama_foto);
                // Storage::putFileAs('public/barang', $foto_path, $nama_foto);
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
                    'tahun_masuk' => $tahun,
                    'harga' => $harga_satuan
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

    public function print($id)
    {
        $data = Aset::where(DB::raw('md5(id)'), $id)->first();
        $jenis = $data->jenis;

        if ($jenis == 'aset') {
            $pdf = Pdf::loadView('print.print-aset-single', [
                'data' => $data
            ])->setPaper('a4', 'portrait');
        } elseif ($jenis == 'kendaraanDinas') {
            $pdf = Pdf::loadView('print.print-aset-kendaraan-single', [
                'data' => $data
            ])->setPaper('a4', 'portrait');
        }

        return $pdf->stream();
    }

    public function hapus($id)
    {
        $data = Aset::where(DB::raw('md5(id)'), $id)->first();
        $data->delete();
        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.aset.index');
    }

    public function detail($id)
    {
        $data = Aset::where(DB::raw('md5(id)'), $id)->first();
        $pegawai = Pegawai::all();

        return view('pages.admin.aset.detail', [
            'data' => $data,
            'pegawai' => $pegawai
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

    public function export(Collection $asetCollection, string $jenis)
    {
        self::updateAsetPrinted($asetCollection);

        if ($jenis == 'aset') {
            $pdf = Pdf::loadView('print.print-aset', [
                'data' => $asetCollection
            ])->setPaper('a4', 'portrait');
        } elseif ($jenis == 'kendaraanDinas') {
            $pdf = Pdf::loadView('print.print-aset-kendaraan', [
                'data' => $asetCollection
            ])->setPaper('a4', 'portrait');
        }

        return $pdf;
    }

    private function updateAsetPrinted(Collection $asetCollection)
    {
        foreach ($asetCollection as $key => $aset) {
            $lastNum = is_null($aset->print) ? 0 : $aset->print;
            $aset->update([
                'print' => $lastNum + 1
            ]);
        }
    }

    private function generateDataForExport(Collection $asetList, ?string $kondisi = null, ?int $ruanganId = null)
    {
        $asetList = Aset::getDistinctAset($asetList);

        if (!is_null($kondisi)) {
            $jumlahBaik = 0;
            $jumlahCukupBaik = 0;
            $jumlahRusak = 0;
            $jumlahRusakBerat = 0;
            foreach ($asetList as $key => $aset) {

                if ($kondisi == 'baik') {
                    $jumlahBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'baik']
                    ])->count();
                } elseif ($kondisi == 'cukup_baik') {
                    $jumlahCukupBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'cukup_baik']
                    ])->count();
                } elseif ($kondisi == 'rusak') {
                    $jumlahRusak = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak']
                    ])->count();
                } elseif ($kondisi == 'rusak_berat') {
                    $jumlahRusakBerat = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak_berat']
                    ])->count();
                }
                $asetList[$aset['kode']]['total_barang'] = $jumlahBaik + $jumlahCukupBaik + $jumlahRusak + $jumlahRusakBerat;
                $asetList[$aset['kode']]['kondisi'] = [
                    'baik' => $jumlahBaik,
                    'cukup_baik' => $jumlahCukupBaik,
                    'rusak' => $jumlahRusak,
                    'rusak_berat' => $jumlahRusakBerat
                ];
            }
        } else {
            foreach ($asetList as $key => $aset) {
                if (!is_null($ruanganId)) {
                    $jumlahBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'baik'],
                        ['ruangan_id', '=', $ruanganId]
                    ])->count();
                    $jumlahCukupBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'cukup_baik'],
                        ['ruangan_id', '=', $ruanganId]
                    ])->count();
                    $jumlahRusakBerat = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak_berat'],
                        ['ruangan_id', '=', $ruanganId]
                    ])->count();
                    //gk kepake
                    $jumlahRusak = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak'],
                        ['ruangan_id', '=', $ruanganId]
                    ])->count();
                } else {
                    $jumlahBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'baik']
                    ])->count();
                    $jumlahCukupBaik = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'cukup_baik']
                    ])->count();
                    $jumlahRusakBerat = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak_berat']
                    ])->count();
                    //gk kepake
                    $jumlahRusak = Aset::where([
                        ['kode', '=', $aset['kode']],
                        ['kondisi', '=', 'rusak']
                    ])->count();
                }

                $asetList[$aset['kode']]['total_barang'] = $jumlahBaik + $jumlahCukupBaik + $jumlahRusak + $jumlahRusakBerat;
                $asetList[$aset['kode']]['kondisi'] = [
                    'baik' => $jumlahBaik,
                    'cukup_baik' => $jumlahCukupBaik,
                    'rusak' => $jumlahRusak,
                    'rusak_berat' => $jumlahRusakBerat
                ];
            }
        }
        return $asetList;
    }

    public function exportInventaris(Request $request)
    {
        $filterBy = $request->radioFilter;
        $error = false;
        $query = Aset::query(); // Initialize the query builder

        switch (ucwords($filterBy)) {
            case 'Kondisi':
                $error = is_null($request->kondisi);
                if (!$error) {
                    $query->where('kondisi', '=', $request->kondisi);
                }
                break;
            case 'Tahun':
                $error = is_null($request->tahun);
                if (!$error) {
                    $query->where('tahun_masuk', '=', $request->tahun);
                }
                break;
            case 'Barang':
                $error = is_null($request->aset_id);
                if (!$error) {
                    $aset = Aset::findOrFail($request->aset_id);
                    $query->where('kode', '=', $aset->kode);
                }
                break;
            case 'Penanggung Jawab':
                $error = is_null($request->pegawai_id);
                if (!$error) {
                    $query->where('pegawai_id', '=', $request->pegawai_id);
                }
                break;
            default:
                $error = true;
                break;
        }

        if ($error) {
            return redirect()->back()
                ->withErrors(['validation' => 'Harap isi kolom input dengan benar'])
                ->withInput();
        }

        $asetList = $query->get();
        if (ucwords($filterBy) == 'Kondisi') {
            $data = self::generateDataForExport($asetList, $request->kondisi);
        } else {
            $data = self::generateDataForExport($asetList);
        }

        if ($request->isExcel === 'true') {
            $currentDate = Carbon::now()->format('d-m-Y');
            $fileName = 'Laporan-Inventaris-Barang-' . $currentDate;
            return Excel::download(new LaporanInventarisBarangExport($data), $fileName . '.xlsx');
        } else {
            $camat = Pegawai::where('jabatan', '=', 'Camat Martapura')->first();
            $pdf = Pdf::loadView('print.print-inventaris-barang', [
                'data' => $data,
                'camat' => $camat
            ])->setPaper('a4', 'landscape');

            return $pdf->stream();
        }
    }

    public function exportKir(Request $request)
    {
        $asetList = Aset::where('ruangan_id', '=', $request->ruangan_id)->get();
        $ruangan = Ruangan::findOrFail($request->ruangan_id);
        $camat = Pegawai::where('jabatan', '=', 'Camat Martapura')->first();

        $data = self::generateDataForExport($asetList, null, (int) $request->ruangan_id);

        if ($request->isExcel === 'true') {
            $currentDate = Carbon::now()->format('d-m-Y');
            $fileName = 'Kir-' . $ruangan->nama_ruangan . '-' . $currentDate;
            return Excel::download(new KartuInventarisRuanganExport($data), $fileName . '.xlsx');
        } else {
            $pdf = Pdf::loadView('print.print-kir', [
                'data' => $data,
                'ruangan' => $ruangan,
                'camat' => $camat
            ])->setPaper('a4', 'landscape');

            return $pdf->stream();
        }
    }

    public function exportPaktaIntegritas(Request $request)
    {
        $pihakPertama = Pegawai::findOrFail($request->pihak_pertama);
        $pihakKedua = Pegawai::findOrFail($request->pihak_kedua);
        $camat = Pegawai::where('jabatan', '=', 'Camat Martapura')->first();

        $aset = Aset::where('pegawai_id', '=', $request->pihak_pertama)->get();

        $pdf = Pdf::loadView('print.print-pakta-integritas', [
            'pihakPertama' => $pihakPertama,
            'pihakKedua' => $pihakKedua,
            'aset' => $aset,
            'camat' => $camat
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function exportBAST(Request $request)
    {
        $pihakPertama = Pegawai::findOrFail($request->pihak_pertama);
        $pihakKedua = Pegawai::findOrFail($request->pihak_kedua);
        $camat = Pegawai::where('jabatan', '=', 'Camat Martapura')->first();

        $aset = Aset::findOrFail($request->id_aset);

        if ($aset->jenis = 'kendaraanDinas') {
            $jenis = 'Kendaraan Dinas';
        } else {
            $jenis = 'Aset';
        }

        $pdf = Pdf::loadView('print.print-bast', [
            'pihakPertama' => $pihakPertama,
            'pihakKedua' => $pihakKedua,
            'aset' => $aset,
            'camat' => $camat,
            'jenis' => $jenis
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
