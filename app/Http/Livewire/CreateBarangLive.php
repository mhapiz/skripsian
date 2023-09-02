<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBarangLive extends Component
{
    use WithFileUploads;
    public $nama_barang, $kode_barang, $merk, $foto_path;

    public function resetFields()
    {
        $this->nama_barang = null;
        $this->kode_barang = null;
        $this->merk = null;
        $this->foto_path = null;
    }

    public function storeBarang()
    {
        $req = $this->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'merk' => 'required',
            'foto_path' => 'image|mimes:png,jpg,jpeg|nullable',
        ]);

        if ($this->foto_path) {
            $extension = $this->foto_path->extension();
            $nama_foto = Str::slug($req['nama_barang']) . '-' . Str::slug($req['kode_barang']) . '-' . time() . '.' . $extension;

            $this->foto_path->storeAs('public/barang', $nama_foto);

            $req['foto_path'] = $nama_foto;
        } else {
            $req['foto_path'] = 'default.jpg';
        }

        Barang::create($req);

        $this->resetFields();
        $this->emit('barangSaved');
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Barang Baru Ditambahkan!']
        );
    }

    public function render()
    {
        return view('livewire.create-barang-live');
    }
}
