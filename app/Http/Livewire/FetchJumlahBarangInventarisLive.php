<?php

namespace App\Http\Livewire;

use App\Models\Inventaris;
use Livewire\Component;

class FetchJumlahBarangInventarisLive extends Component
{
    public $barangFree;
    public $barang_id;
    public $jumlahBarang;

    public function mount($barang_id = null)
    {
        $this->barang_id = $barang_id;
    }

    public function render()
    {
        if ($this->barang_id != null) {
            $hitungJumlahBarang = Inventaris::where([
                ['barang_id', $this->barang_id],
                ['ruangan_id', '=', null]
            ])->get()->count();
            $this->jumlahBarang = $hitungJumlahBarang;
        }
        $this->barangFree = Inventaris::select('barang_id')->where('ruangan_id', '=', null)->distinct()->with('barang')->get();
        return view('livewire.fetch-jumlah-barang-inventaris-live');
    }
}
