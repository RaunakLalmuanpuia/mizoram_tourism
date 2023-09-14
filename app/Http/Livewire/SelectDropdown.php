<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectDropdown extends Component
{
	public $itemSelected;
	public $items;

	public function render()
	{
		return view('livewire.select-dropdown');
	}
}
