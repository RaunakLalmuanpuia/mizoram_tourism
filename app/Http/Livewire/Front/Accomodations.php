<?php

namespace App\Http\Livewire\Front;

use App\Models\DistrictMetaData;
use App\Models\Lodge;
use App\Models\LodgeRoomData;
use App\Models\LodgeRoomType;
use Livewire\Component;
use Livewire\WithPagination;

class Accomodations extends Component
{
  use WithPagination;
  public $districtId;
  public $selectedDistrict = 1;
  public $districts = [];

  public function mount()
  {
    $roomTypes = LodgeRoomType::pluck('id');
    $rooms = LodgeRoomData::whereIn('lodge_room_types_id', $roomTypes)->where('param1', 'Enable')->pluck('lodges_id');
    $this->lodges = Lodge::whereIn('id', $rooms)->where('district_meta_data_id', $this->districtId)->get();
    $this->selectedDistrict = 1;
    $this->districts = DistrictMetaData::get();
  }

  public function onDistrictClicked($id)
  {
    $this->selectedDistrict = $id;
    $this->districtId = $this->selectedDistrict;
  }

  public function render()
  {
    $roomTypes = LodgeRoomType::pluck('id');
    $rooms = LodgeRoomData::whereIn('lodge_room_types_id', $roomTypes)->where('param1', 'Enable')->pluck('lodges_id');
    $lodgeRooms = LodgeRoomData::where('district_meta_data_id', $this->districtId)->pluck('lodges_id');
    $accomodations = Lodge::whereIn('id', $rooms)->whereIn('id', $lodgeRooms)->with('districtMetaData')->get();
    return view('livewire.front.accomodations', ['accomodations' => $accomodations]);
  }
}
