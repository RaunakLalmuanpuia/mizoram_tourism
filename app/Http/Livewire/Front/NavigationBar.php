<?php

namespace App\Http\Livewire\Front;

use App\Models\About;
use App\Models\DistrictMetaData;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavigationBar extends Component
{
  public $districts = [];
  public $tags;
  public $aboutUs;

  public function mount()
  {
    $this->districts = DistrictMetaData::get();
    $this->aboutUs = About::get();
    $this->tags = Tag::get();
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('home');
  }

  public function render()
  {
    return view('livewire.front.navigation-bar');
  }
}
