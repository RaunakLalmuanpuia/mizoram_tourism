<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DistrictImages extends Component
{
  public $showGallery = false;
  public $images;

  public function imageClicked()
  {
    $this->showGallery = true;
  }

  public function render()
  {
    return view('livewire.district-images');
  }
}
