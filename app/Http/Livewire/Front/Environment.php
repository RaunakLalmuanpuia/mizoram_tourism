<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Environment extends Component
{
  public $environments;

  public function mount()
  {
  }
  public function render()
  {
    return view('livewire.front.environment');
  }
}
