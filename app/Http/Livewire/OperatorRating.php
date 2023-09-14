<?php

namespace App\Http\Livewire;

use App\Models\Operator;
use App\Models\OperatorRating as ModelsOperatorRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OperatorRating extends Component
{
  use WithPagination;
  public $ratingDialog;
  public $selectedOperator;
  public $userRating = 0;
  public $review;

  public function mount()
  {
    $this->ratingDialog = false;
  }

  public function onGuideClick($agent)
  {
    $this->ratingDialog = true;
    $this->selectedOperator = $agent;
  }

  public function onRatingClicked($rate)
  {
    $this->userRating = $rate;
  }

  public function giveRating()
  {
    if (Auth::check()) {
      $rating = new ModelsOperatorRating;
      $rating->operators_id = $this->selectedOperator['id'];
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
    $operators = Operator::paginate(30);
    return view('livewire.operator-rating', ['operators' => $operators]);
  }
}
