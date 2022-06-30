<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowProduct extends Component
{
    public $data = null;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.show-product', [
            'data' => $this->data,
        ]);
    }
}
