<?php

namespace App\Http\Livewire;

use App\Models\Guide;
use App\Models\GuideRating as ModelsGuideRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GuideRating extends Component
{
  use WithPagination;
  public $ratingDialog;
  public $selectedGuide;
  public $userRating = 0;
  public $review;

  public function mount()
  {
    $this->ratingDialog = false;
  }

  public function onGuideClick($guide)
  {
    $this->ratingDialog = true;
    $this->selectedGuide = $guide;
  }

  public function onRatingClicked($rate)
  {
    $this->userRating = $rate;
  }

  public function giveRating()
  {
    if (Auth::check()) {
      $rating = new ModelsGuideRating;
      $rating->guides_id = $this->selectedGuide['id'];
      $rating->user_id = Auth::user()->id;
      $rating->vote = $this->userRating;
      $rating->review = $this->review;
      $rating->save();
      $this->review = null;
      $this->userRating = 0;
      $this->ratingDialog = false;
    } else {
      $this->ratingDialog = false;
      $this->emit('login');
    }
  }

  public function render()
  {
    $guides = Guide::paginate(30);
    return view('livewire.guide-rating', ['guides' => $guides]);
  }
}
