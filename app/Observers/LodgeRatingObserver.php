<?php

namespace App\Observers;

use App\Models\Lodge;
use App\Models\LodgeRating;

class LodgeRatingObserver
{
    /**
     * Handle the LodgeRating "created" event.
     *
     * @param  \App\Models\LodgeRating  $lodgeRating
     * @return void
     */
    public function created(LodgeRating $lodgeRating)
    {
        $totalRatings=LodgeRating::where('lodges_id',$lodgeRating->lodges_id)->sum('vote');
        $ratingCount=LodgeRating::where('lodges_id',$lodgeRating->lodges_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $lodge=Lodge::findOrFail($lodgeRating->lodges_id);
        $lodge->average_ratings=number_format($averageRating,1);
        $lodge->save();
    }

    /**
     * Handle the LodgeRating "updated" event.
     *
     * @param  \App\Models\LodgeRating  $lodgeRating
     * @return void
     */
    public function updated(LodgeRating $lodgeRating)
    {
        //
    }

    /**
     * Handle the LodgeRating "deleted" event.
     *
     * @param  \App\Models\LodgeRating  $lodgeRating
     * @return void
     */
    public function deleted(LodgeRating $lodgeRating)
    {
        //
    }

    /**
     * Handle the LodgeRating "restored" event.
     *
     * @param  \App\Models\LodgeRating  $lodgeRating
     * @return void
     */
    public function restored(LodgeRating $lodgeRating)
    {
        //
    }

    /**
     * Handle the LodgeRating "force deleted" event.
     *
     * @param  \App\Models\LodgeRating  $lodgeRating
     * @return void
     */
    public function forceDeleted(LodgeRating $lodgeRating)
    {
        //
    }
}
