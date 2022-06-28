<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;

class FetchOptionBarangLive extends Component
{
    public $all_barang;

    protected $listeners = [
        'barangSaved' => '$refresh',
    ];

    public function render()
    {
        $this->all_barang = Barang::all();
        return view('livewire.fetch-option-barang-live');
    }
}
