<?php

namespace App\Http\Livewire;

use App\Models\DistrictMetaData;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class GlimpseOfDistricts extends Component
{
  public $districts;
  public $selectedDistrict;
  public $lat;
  public $lon;
  public $temperature = 0;
  public $weather;
  public $weatherIcon;

  public function mount()
  {
    $this->selectedDistrict = DistrictMetaData::first();
    $this->lat = $this->selectedDistrict->latitude;
    $this->lon = $this->selectedDistrict->longitude;
    $result = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$this->lat&lon=$this->lon&appid=73fbd66f3f068367e084ffe31956d5bc&units=metric");
    $this->temperature = $result['main']['temp'];
    $this->weather = $result['weather'][0]['main'];
    $this->weatherIcon = $result['weather'][0]['icon'];
  }

  public function onDistrictClicked(DistrictMetaData $district)
  {
    $this->selectedDistrict = $district;
    $this->lat = $district->latitude;
    $this->lon = $district->longitude;
    $result = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$this->lat&lon=$this->lon&appid=73fbd66f3f068367e084ffe31956d5bc&units=metric");
    $this->temperature = $result['main']['temp'];
    $this->weather = $result['weather'][0]['main'];
    $this->weatherIcon = $result['weather'][0]['icon'];
  }

  public function render()
  {
    return view('livewire.glimpse-of-districts');
  }
}
