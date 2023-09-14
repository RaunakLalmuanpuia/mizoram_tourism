<?php

namespace App\Http\Livewire;

use App\Models\Pledge;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TakePledge extends Component
{
  public $successfulPledge;
  public $pledged = false;

  public function mount()
  {
    if (Auth::check()) {
      $pledge = Pledge::where('user_id', Auth::user()->id)->first();
      if ($pledge != null) {
        $this->pledged = true;
      }
    }
  }

  public function takeAPledge()
  {
    if (Auth::check()) {
      $pledge = new Pledge;
      $pledge->user_id = Auth::user()->id;
      $pledge->save();
      $this->successfulPledge = true;
    } else {
      $this->emit('login');
    }
  }
  public function render()
  {
    return view('livewire.take-pledge');
  }
}
