<?php

namespace App\Http\Livewire;

use App\Models\Suplier;
use Livewire\Component;

class CreateSuplierLive extends Component
{
    public $nama_suplier, $kota, $no_telp, $alamat;

    public function resetFields()
    {
        $this->nama_suplier = null;
        $this->kota = null;
        $this->no_telp = null;
        $this->alamat = null;
    }

    public function storeSuplier()
    {
        $req = $this->validate([
            'nama_suplier' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        Suplier::create($req);

        $this->resetFields();
        $this->emit('suplierSaved');
        $this->emitTo('fetch-option-suplier-live', '$refresh');
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suplier Baru Ditambahkan!']
        );
    }
    public function render()
    {
        return view('livewire.create-suplier-live');
    }
}
