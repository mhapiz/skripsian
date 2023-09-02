<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Admin\AdminAsetController;
use App\Models\Aset;
use Livewire\Component;

class ExportAset extends Component
{
    public $asetList;

    public $aset_id;
    public $dari;
    public $sampai;

    public $note = null;

    protected $listeners = ['updateAsetSelected' => 'asetSelected'];

    public function mount()
    {
        $this->asetList = Aset::getUniqueAssets();
    }

    public function resetFields()
    {
        $this->aset_id = null;
        $this->dari = null;
        $this->sampai = null;
    }

    function export()
    {
        $aset = Aset::findOrFail($this->aset_id);
        $asetCollection = Aset::where([
            ['nama', '=', $aset->nama],
            ['kode', '=', $aset->kode],
            ['merk', '=', $aset->merk],
        ])
            ->whereBetween('register', [$this->dari, $this->sampai])
            ->orderBy('register', 'ASC')->get();

        $asetController = new AdminAsetController();
        $pdf = $asetController->export($asetCollection, $aset->jenis);
        $filename = 'QR ' . $aset->nama . '-' . $aset->kode . '-' . $this->dari . '-' . $this->sampai . '.pdf';
        $this->emit('exported');
        $this->resetFields();
        return response()->streamDownload(function () use ($pdf) {
            echo  $pdf->stream();
        }, $filename);
    }

    public function asetSelected()
    {
        $aset = Aset::findOrFail($this->aset_id);
        $firstPrintableAset = Aset::where([
            ['nama', '=', $aset->nama],
            ['kode', '=', $aset->kode],
            ['merk', '=', $aset->merk],
            ['print', '=', null]
        ])->orderBy('register', 'ASC')->first();

        $lastPrintableAset = Aset::where([
            ['nama', '=', $aset->nama],
            ['kode', '=', $aset->kode],
            ['merk', '=', $aset->merk],
            ['print', '=', null]
        ])->orderBy('register', 'DESC')->first();

        $firstAset = Aset::where([
            ['nama', '=', $aset->nama],
            ['kode', '=', $aset->kode],
            ['merk', '=', $aset->merk],
        ])->orderBy('register', 'ASC')->first();

        $lastAset = Aset::where([
            ['nama', '=', $aset->nama],
            ['kode', '=', $aset->kode],
            ['merk', '=', $aset->merk],
        ])->orderBy('register', 'DESC')->first();

        $this->dari = $firstPrintableAset->register ?? 0;
        $this->sampai = $lastPrintableAset->register ?? 0;

        $this->note = 'Aset ' .
            $aset->nama . ' tersedia dari nomor register ' .
            $firstAset->register . ' - ' . $lastAset->register;
    }

    public function render()
    {
        return view('livewire.export-aset');
    }
}
