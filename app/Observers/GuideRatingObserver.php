<?php

namespace App\Observers;

use App\Models\Guide;
use App\Models\GuideRating;

class GuideRatingObserver
{
    /**
     * Handle the GuideRating "created" event.
     *
     * @param  \App\Models\GuideRating  $guideRating
     * @return void
     */
    public function created(GuideRating $guideRating)
    {
        $totalRatings=GuideRating::where('guides_id',$guideRating->guides_id)->sum('vote');
        $ratingCount=GuideRating::where('guides_id',$guideRating->guides_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $guide=Guide::findOrFail($guideRating->guides_id);
        $guide->average_ratings=number_format($averageRating,1);
        $guide->save();
    }

    /**
     * Handle the GuideRating "updated" event.
     *
     * @param  \App\Models\GuideRating  $guideRating
     * @return void
     */
    public function updated(GuideRating $guideRating)
    {
        //
    }

    /**
     * Handle the GuideRating "deleted" event.
     *
     * @param  \App\Models\GuideRating  $guideRating
     * @return void
     */
    public function deleted(GuideRating $guideRating)
    {
        //
    }

    /**
     * Handle the GuideRating "restored" event.
     *
     * @param  \App\Models\GuideRating  $guideRating
     * @return void
     */
    public function restored(GuideRating $guideRating)
    {
        //
    }

    /**
     * Handle the GuideRating "force deleted" event.
     *
     * @param  \App\Models\GuideRating  $guideRating
     * @return void
     */
    public function forceDeleted(GuideRating $guideRating)
    {
        //
    }
}
