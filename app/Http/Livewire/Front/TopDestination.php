<?php

namespace App\Http\Livewire\Front;

use App\Models\DestinationImage;
use App\Models\DistrictMetaData;
use App\Models\DistrictTopDestination;
use App\Models\Image;
use Livewire\Component;

class TopDestination extends Component
{
  public $districtId;

  public function render()
  {
    $district = DistrictMetaData::where('id', $this->districtId)->with('districtTopDestination')->first();
    $districtTopDestinations = DistrictTopDestination::where('district_meta_data_id', $this->districtId)->pluck('id');
    $topDestinationImages = DestinationImage::whereIn('district_top_destinations_id', $districtTopDestinations)->pluck('images_id');
    $images = Image::whereIn('id', $topDestinationImages)->first();
    return view('livewire.front.top-destination', ['district' => $district, 'images' => $images]);
  }
}
