<?php

namespace App\Http\Livewire;

use App\Models\Aset;
use App\Models\Inventaris;
use Livewire\Component;

class FetchJumlahBarangInventarisLive extends Component
{
    public $barangFree = null;
    public $asetFree;

    public $idx;
    public $aset_id;
    public $jumlahBarang;
    public $arrKondisi;
    public $kondisi = null;

    public function mount($aset_id = null, $idx)
    {
        $this->idx = $idx;
        $this->aset_id = $aset_id;
    }

    public function render()
    {
        if ($this->aset_id !== null) {
            $aset = Aset::findOrFail($this->aset_id);
            $collectionAset = Aset::where([
                ['nama', '=', $aset->nama],
                ['kode', '=', $aset->kode],
                ['merk', '=', $aset->merk]
            ])->get();

            $arrKondisi = [];
            foreach ($collectionAset as $key => $ast) {
                $arrKondisi[] = $ast->kondisi;
            }
            $arrKondisi = array_unique($arrKondisi);
            $this->arrKondisi = $arrKondisi;
        }

        if ($this->aset_id !== null && $this->kondisi !== null) {
            $aset = Aset::findOrFail($this->aset_id);
            $collectionAset = Aset::where([
                ['nama', '=', $aset->nama],
                ['kode', '=', $aset->kode],
                ['merk', '=', $aset->merk],
                ['kondisi', '=', $this->kondisi],
                ['jenis_kepemilikan', '=', null]
            ])->get();

            $this->jumlahBarang = $collectionAset->count();
        }

        if ($this->barangFree == null) {
            $this->barangFree = Aset::getFreeUniqueAset();
        }
        return view('livewire.fetch-jumlah-barang-inventaris-live');
    }
}
