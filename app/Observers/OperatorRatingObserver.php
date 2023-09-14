<?php

namespace App\Observers;

use App\Models\Operator;
use App\Models\OperatorRating;

class OperatorRatingObserver
{
    /**
     * Handle the OperatorRating "created" event.
     *
     * @param  \App\Models\OperatorRating  $operatorRating
     * @return void
     */
    public function created(OperatorRating $operatorRating)
    {
        $totalRatings=OperatorRating::where('operators_id',$operatorRating->operators_id)->sum('vote');
        $ratingCount=OperatorRating::where('operators_id',$operatorRating->operators_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $operator=Operator::findOrFail($operatorRating->operators_id);
        $operator->average_ratings=number_format($averageRating,1);
        $operator->save();

    }

    /**
     * Handle the OperatorRating "updated" event.
     *
     * @param  \App\Models\OperatorRating  $operatorRating
     * @return void
     */
    public function updated(OperatorRating $operatorRating)
    {
        //
    }

    /**
     * Handle the OperatorRating "deleted" event.
     *
     * @param  \App\Models\OperatorRating  $operatorRating
     * @return void
     */
    public function deleted(OperatorRating $operatorRating)
    {
        //
    }

    /**
     * Handle the OperatorRating "restored" event.
     *
     * @param  \App\Models\OperatorRating  $operatorRating
     * @return void
     */
    public function restored(OperatorRating $operatorRating)
    {
        //
    }

    /**
     * Handle the OperatorRating "force deleted" event.
     *
     * @param  \App\Models\OperatorRating  $operatorRating
     * @return void
     */
    public function forceDeleted(OperatorRating $operatorRating)
    {
        //
    }
}
