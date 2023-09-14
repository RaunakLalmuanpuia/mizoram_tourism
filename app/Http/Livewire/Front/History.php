<?php

namespace App\Http\Livewire\Front;

use App\Models\Mizoram;
use Livewire\Component;

class History extends Component
{
  public $histories;

  public function mount()
  {
    $this->histories = Mizoram::get();
  }

  public function render()
  {
    return view('livewire.front.history');
  }
}
