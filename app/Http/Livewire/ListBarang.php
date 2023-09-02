<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;

class ListBarang extends Component
{
    public function render()
    {
        $barang = Barang::paginate(1);
        return view('livewire.list-barang', [
            'barang' => $barang
        ]);
    }
}
