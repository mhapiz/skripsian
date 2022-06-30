<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pegawai;
use App\Models\GajiPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Riskihajar\Terbilang\Facades\Terbilang;
use Yajra\DataTables\Facades\DataTables;

class AdminGajiPegawaiController extends Controller
{
    public function index()
    {
        return view('pages.admin.gaji-pegawai.index');
    }

    public function getData()
    {
        $data = GajiPegawai::with('pegawai')->latest();

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $editUrl = route('admin.gaji-pegawai.edit', $row->id_gaji_pegawai);
                $deleteUrl = route('admin.gaji-pegawai.destroy', $row->id_gaji_pegawai);
                $printUrl = route('admin.gaji-pegawai.printDetail', $row->id_gaji_pegawai);

                return view('modules.backend._formActionsWithPrint', compact('editUrl', 'deleteUrl', 'printUrl'));
            })
            ->editColumn('nama_pegawai', function ($row) {
                return $row->pegawai->nama_pegawai;
            })
            ->editColumn('bulan', function ($row) {
                switch ($row->bulan) {
                    case '01':
                        $bulan = 'Januari';
                        break;
                    case '02':
                        $bulan = 'Februari';
                        break;
                    case '03':
                        $bulan = 'Maret';
                        break;
                    case '04':
                        $bulan = 'April';
                        break;
                    case '05':
                        $bulan = 'Mei';
                        break;
                    case '06':
                        $bulan = 'Juni';
                        break;
                    case '07':
                        $bulan = 'Juli';
                        break;
                    case '08':
                        $bulan = 'Agustus';
                        break;
                    case '09':
                        $bulan = 'September';
                        break;
                    case '10':
                        $bulan = 'Oktober';
                        break;
                    case '11':
                        $bulan = 'November';
                        break;
                    case '12':
                        $bulan = 'Desember';
                        break;
                    default:
                        $row->bulan;
                        break;
                }
                return $bulan . ' ' . $row->tahun;
            })
            ->editColumn('total_gaji', function ($row) {
                return 'Rp. ' . number_format($row->total_gaji, 0, ',', '.');
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function printDetail($id)
    {
        $data = GajiPegawai::with('pegawai')->findOrFail($id);

        $pangkat = Pangkat::find($data->pegawai->pangkat_id);

        $data['gaji_terbilang'] = Terbilang::make($data->total_gaji);

        $pdf = Pdf::loadView('print.print-detail-gaji-pegawai', [
            'data' => $data,
            'pangkat' => $pangkat,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function printRekap()
    {
        $data = GajiPegawai::with('pegawai')->get();

        $pdf = Pdf::loadView('print.print-rekap-gaji-pegawai', [
            'data' => $data
        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        return view('pages.admin.gaji-pegawai.create', [
            'pegawai' => $pegawai
        ]);
    }

    public function store(Request $request)
    {
        $req =   $request->validate([
            'pegawai_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $pegawai = Pegawai::with('pangkat')->find($request->pegawai_id);

        if (GajiPegawai::where('pegawai_id', $pegawai->id_pegawai)->where('bulan', $req['bulan'])->where('tahun', $req['tahun'])->exists()) {
            Alert::info('Gaji Pegawai Sudah Dibagi!');
            return redirect()->route('admin.gaji-pegawai.index');
        } else {

            $req['total_gaji'] = $pegawai->pangkat->gaji_pokok  - ($pegawai->pangkat->gaji_pokok * $pegawai->pangkat->potongan / 100);

            GajiPegawai::create($req);

            Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
            return redirect()->route('admin.gaji-pegawai.index');
        }
    }

    public function storeMore()
    {
        $getAllPegawai = Pegawai::with('pangkat')->get();
        // get this month in indonesia
        $month = date('m');
        $year = date('Y');

        foreach ($getAllPegawai as $value) {
            // if pegawai is already have gaji this month, then skip it
            if (GajiPegawai::where('pegawai_id', $value->id_pegawai)->where('bulan', $month)->where('tahun', $year)->exists()) {
                continue;
            } else {
                $totalGaji = $value->pangkat->gaji_pokok - ($value->pangkat->gaji_pokok * $value->pangkat->potongan / 100);
                GajiPegawai::create([
                    'pegawai_id' => $value->id_pegawai,
                    'bulan' => $month,
                    'tahun' => $year,
                    'total_gaji' => $totalGaji,
                ]);
            }
        }

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
        return redirect()->route('admin.gaji-pegawai.index');
    }

    public function edit($id)
    {
        $data = GajiPegawai::findOrFail($id);
        $pegawai = Pegawai::all();

        return view('pages.admin.gaji-pegawai.edit', [
            'data' => $data,
            'pegawai' => $pegawai,
        ]);
    }

    public function update(Request $request, $id)
    {
        $req =   $request->validate([
            'pegawai_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $pegawai = Pegawai::with('pangkat')->find($request->pegawai_id);
        $req['total_gaji'] = $pegawai->pangkat->gaji_pokok  - ($pegawai->pangkat->gaji_pokok * $pegawai->pangkat->potongan / 100);


        GajiPegawai::findOrFail($id)->update($req);

        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('admin.gaji-pegawai.index');
    }



    public function destroy($id)
    {
        GajiPegawai::findOrFail($id)->delete();

        Alert::info('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('admin.gaji-pegawai.index');
    }
}
