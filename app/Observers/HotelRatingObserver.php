<?php

namespace App\Observers;

use App\Models\Hotel;
use App\Models\HotelRating;
use Illuminate\Support\Facades\Log;

class HotelRatingObserver
{
  /**
   * Handle the HotelRating "created" event.
   *
   * @param  \App\Models\HotelRating  $hotelRating
   * @return void
   */
  public function created(HotelRating $hotelRating)
  {
    $totalRatings = HotelRating::where('hotels_id', $hotelRating->hotels_id)->sum('vote');
    $ratingCount = HotelRating::where('hotels_id', $hotelRating->hotels_id)->count();
    $averageRating = $totalRatings / $ratingCount;

    $hotel = Hotel::findOrFail($hotelRating->hotels_id);
    $hotel->average_ratings = number_format($averageRating, 1);
    $hotel->save();
  }

  /**
   * Handle the HotelRating "updated" event.
   *
   * @param  \App\Models\HotelRating  $hotelRating
   * @return void
   */
  public function updated(HotelRating $hotelRating)
  {
    $totalRatings = HotelRating::where('hotels_id', $hotelRating->hotels_id)->sum('vote');
    $ratingCount = HotelRating::where('hotels_id', $hotelRating->hotels_id)->count();
    $averageRating = $totalRatings / $ratingCount;

    $hotel = Hotel::findOrFail($hotelRating->hotels_id);
    $hotel->average_ratings = number_format($averageRating, 1);
    $hotel->save();
  }

  /**
   * Handle the HotelRating "deleted" event.
   *
   * @param  \App\Models\HotelRating  $hotelRating
   * @return void
   */
  public function deleted(HotelRating $hotelRating)
  {
    //
  }

  /**
   * Handle the HotelRating "restored" event.
   *
   * @param  \App\Models\HotelRating  $hotelRating
   * @return void
   */
  public function restored(HotelRating $hotelRating)
  {
    //
  }

  /**
   * Handle the HotelRating "force deleted" event.
   *
   * @param  \App\Models\HotelRating  $hotelRating
   * @return void
   */
  public function forceDeleted(HotelRating $hotelRating)
  {
    //
  }
}
