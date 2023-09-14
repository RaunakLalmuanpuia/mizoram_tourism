<?php

namespace App\Http\Livewire;

use App\Models\Information;
use Livewire\Component;

class InformationLinks extends Component
{
    public $informations;

    public function mount()
    {
        $this->informations = Information::get();    
    }
    public function render()
    {
        return view('livewire.information-links');
    }
}
