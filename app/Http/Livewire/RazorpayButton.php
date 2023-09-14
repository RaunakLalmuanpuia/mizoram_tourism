<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RazorpayButton extends Component
{
  public $bookingData;
  public $guests;
  public $specialRequest;

  public $listeners = ['guestAdded', 'guestRemoved'];

  public function guestAdded($guests)
  {
    $this->guests = $guests;
  }

  public function guestRemoved($guests)
  {
    $this->guests = $guests;
  }

  public function render()
  {
    return view('livewire.razorpay-button');
  }
}
