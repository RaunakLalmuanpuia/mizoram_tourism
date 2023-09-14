<?php

namespace App\Http\Livewire\Front;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class WeatherForecast extends Component
{
  public $lat;
  public $lon;
  public $temperature = 0;
  public $weather;
  public $weatherIcon;
  public $weatherFetched = true;

  public function mount()
  {
    try{
      $result = Http::get("https://api.openweathermap.org/data/2.5/weather?lat=$this->lat&lon=$this->lon&appid=73fbd66f3f068367e084ffe31956d5bc&units=metric");
      $this->temperature = $result['main']['temp'];
      $this->weather = $result['weather'][0]['main'];
      $this->weatherIcon = $result['weather'][0]['icon'];
    }catch(Throwable $ex){
      $this->weatherFetched = false;
    }
  }
  public function render()
  {
    return view('livewire.front.weather-forecast');
  }
}
