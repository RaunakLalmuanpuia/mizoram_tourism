<?php

namespace App\Http\Livewire;

use App\Models\FestivalCheckIn;
use Livewire\Component;

class WebCheckin extends Component
{
  public $name;
  public $contact;
  public $address;

  public function save()
  {
    $checkIn = new FestivalCheckIn;
    $checkIn->name = $this->name;
    $checkIn->contact = $this->contact;
    $checkIn->address = $this->address;
    $checkIn->save();
    $this->reset();
    session()->flash('message', 'You have successfully registered for lycky draw. You can now close this page');
  }

  public function render()
  {
    return view('livewire.web-checkin')
      ->layout('layouts.guest');
  }
}
