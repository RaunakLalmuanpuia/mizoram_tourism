<?php

namespace App\Http\Livewire;

use App\Models\IpCheckIn as ModelsIpCheckIn;
use Livewire\Component;

class IpCheckin extends Component
{
  public $ip;
  public $signedIn = false;

  public function mount()
  {
    $this->ip = $_SERVER['REMOTE_ADDR'];
    $user = ModelsIpCheckIn::firstOrCreate(['ip_address' => $this->ip]);

    if ($user->save()) {
      session()->flash('message', 'You have successfully checked in. You may now proceed.');
    }
  }

  public function render()
  {
    return view('livewire.ip-checkin')
      ->layout('layouts.guest');
  }
}
