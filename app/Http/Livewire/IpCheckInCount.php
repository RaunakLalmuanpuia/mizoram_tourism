<?php

namespace App\Http\Livewire;

use App\Models\IpCheckIn;
use Livewire\Component;

class IpCheckInCount extends Component
{
  public $guestCount;
  public $guests;

  public function mount()
  {
    $this->guests = IpCheckIn::get();
    $this->guestCount = count($this->guests);
  }

  public function render()
  {
    return view('livewire.ip-check-in-count')
      ->layout('layouts.guest');
  }
}
