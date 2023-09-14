<?php

namespace App\Http\Livewire\Front;

use App\Models\Hotel;
use App\Models\User;
use Livewire\Component;

class HotelAndAccomodation extends Component
{
  public $districts;
  public $type = 'Hotel';
  public $districtsId = 1;
  public $accomodations;

  public function getData($id)
  {
    $this->districtsId = $id;
    $this->accomodations = Hotel::where('district_meta_data_id', $this->districtsId)->get();
  }

  public function mount()
  {
    $this->accomodations = Hotel::where('district_meta_data_id', $this->districtsId)->get();
  }

  public function changeType($type)
  {
    $this->type = $type;
    if ($this->type == 'Homestay') {
      $this->accomodations = User::where('name', 'like', '%homestay%')->get();
    } else {
      $this->accomodations = Hotel::where('district_meta_data_id', $this->districtsId)->get();
    }
  }

  public function render()
  {
    return view('livewire.front.hotel-and-accomodation');
  }
}
