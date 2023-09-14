<?php

namespace App\Http\Livewire;

use App\Models\FestivalCheckIn;
use Livewire\Component;

class WebCheckinCount extends Component
{
  public $checkIns;

  public function mount()
  {
    $this->checkIns = FestivalCheckIn::get();
  }

  public function render()
  {
    return view('livewire.web-checkin-count')
      ->layout('layouts.guest');
  }
}
