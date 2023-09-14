<?php

namespace App\Http\Livewire;

use App\Models\FestivalCheckIn;
use Livewire\Component;

class LuckyDraw extends Component
{
  public $contestants;

  public function mount()
  {
    $this->contestants = FestivalCheckIn::get();
  }

  public function pickLuckyFive()
  {
    $luckyFive = FestivalCheckIn::all()->random(1);
    dd($luckyFive);
  }

  public function render()
  {
    return view('livewire.lucky-draw')
      ->layout('layouts.guest');
  }
}
