<?php

namespace App\Http\Livewire\Front;

use App\Models\DistrictTopDestination;
use App\Models\Tag;
use Livewire\Component;

class ThingsToDo extends Component
{
  public $activity;
  public $activities;

  public function mount()
  {
    $this->activities = Tag::where('name', $this->activity)->with('districtTopDestinations')->get();
    // $this->activities = DistrictTopDestination::where('tags', 'LIKE', '%' . $this->activity . '%')->get();
  }
  public function render()
  {
    return view('livewire.front.things-to-do');
  }
}
