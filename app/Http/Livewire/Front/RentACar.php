<?php

namespace App\Http\Livewire\Front;

use App\Models\Hiring;
use App\Models\Rental;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class RentACar extends Component
{
  use WithPagination;
  public $districts;
  public $districtsId = 1;
  public $hiringRate = false;
  public $hiringRates;
  public $columnNames;

  public function mount()
  {
    $this->hiringRates = Hiring::get();
    $this->columnNames = ['Minimun Hiring Charge', 'Rate per km', 'Rate per hour/on duty waiting charge', 'Rate per hour/on duty waiting charge'];

    // dd($this->columnNames);
  }

  public function getData($id)
  {
    $this->districtsId = $id;
  }

  public function showHiringRate()
  {
    $this->hiringRate = true;
  }

  public function render()
  {
    $operators = Rental::where('district_meta_data_id', $this->districtsId)->simplePaginate(18);
    return view('livewire.front.rent-a-car', compact('operators'));
  }
}
