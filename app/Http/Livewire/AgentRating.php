<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use App\Models\AgentRating as ModelsAgentRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AgentRating extends Component
{
  use WithPagination;
  public $ratingDialog;
  public $selectedAgent;
  public $userRating = 0;
  public $review;

  public function mount()
  {
    $this->ratingDialog = false;
  }

  public function onGuideClick($agent)
  {
    $this->ratingDialog = true;
    $this->selectedAgent = $agent;
  }

  public function onRatingClicked($rate)
  {
    $this->userRating = $rate;
  }

  public function giveRating()
  {
    if (Auth::check()) {
      $rating = new ModelsAgentRating;
      $rating->agents_id = $this->selectedAgent['id'];
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
    $agents = Agent::paginate(30);
    return view('livewire.agent-rating', ['agents' => $agents]);
  }
}
