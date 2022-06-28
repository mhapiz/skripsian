<?php

namespace App\Http\Livewire;

use App\Models\Suplier;
use Livewire\Component;

class FetchOptionSuplierLive extends Component
{
    public $all_suplier;
    public $suplier_id = null;

    protected $listeners = [
        '$refresh',
    ];

    public function mount($selected_id = null)
    {
        $this->suplier_id = $selected_id;
        $this->all_suplier = Suplier::all();
    }


    public function render()
    {
        return view('livewire.fetch-option-suplier-live');
    }
}
