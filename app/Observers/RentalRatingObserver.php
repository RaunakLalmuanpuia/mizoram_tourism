<?php

namespace App\Observers;

use App\Models\Rental;
use App\Models\RentalRating;

class RentalRatingObserver
{
    /**
     * Handle the RentalRating "created" event.
     *
     * @param  \App\Models\RentalRating  $rentalRating
     * @return void
     */
    public function created(RentalRating $rentalRating)
    {
        $totalRatings=RentalRating::where('rentals_id',$rentalRating->rentals_id)->sum('vote');
        $ratingCount=RentalRating::where('rentals_id',$rentalRating->rentals_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $rental=Rental::findOrFail($rentalRating->rentals_id);
        $rental->average_ratings=number_format($averageRating,1);
        $rental->save();
    }

    /**
     * Handle the RentalRating "updated" event.
     *
     * @param  \App\Models\RentalRating  $rentalRating
     * @return void
     */
    public function updated(RentalRating $rentalRating)
    {
        //
    }

    /**
     * Handle the RentalRating "deleted" event.
     *
     * @param  \App\Models\RentalRating  $rentalRating
     * @return void
     */
    public function deleted(RentalRating $rentalRating)
    {
        //
    }

    /**
     * Handle the RentalRating "restored" event.
     *
     * @param  \App\Models\RentalRating  $rentalRating
     * @return void
     */
    public function restored(RentalRating $rentalRating)
    {
        //
    }

    /**
     * Handle the RentalRating "force deleted" event.
     *
     * @param  \App\Models\RentalRating  $rentalRating
     * @return void
     */
    public function forceDeleted(RentalRating $rentalRating)
    {
        //
    }
}
