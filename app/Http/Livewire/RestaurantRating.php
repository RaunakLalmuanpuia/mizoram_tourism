<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use App\Models\RestaurantRating as ModelsRestaurantRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantRating extends Component
{
  use WithPagination;
  public $ratingDialog;
  public $selectedRestaurant;
  public $userRating = 0;
  public $review;

  public function mount()
  {
    $this->ratingDialog = false;
  }

  public function onGuideClick($restaurant)
  {
    $this->ratingDialog = true;
    $this->selectedRestaurant = $restaurant;
  }

  public function onRatingClicked($rate)
  {
    $this->userRating = $rate;
  }

  public function giveRating()
  {
    if (Auth::check()) {
      $rating = new ModelsRestaurantRating;
      $rating->restaurants_id = $this->selectedRestaurant['id'];
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
    $restaurants = Restaurant::paginate(30);
    return view('livewire.restaurant-rating', ['restaurants' => $restaurants]);
  }
}
