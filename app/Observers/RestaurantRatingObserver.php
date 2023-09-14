<?php

namespace App\Observers;

use App\Models\Restaurant;
use App\Models\RestaurantRating;

class RestaurantRatingObserver
{
    /**
     * Handle the RestaurantRating "created" event.
     *
     * @param  \App\Models\RestaurantRating  $restaurantRating
     * @return void
     */
    public function created(RestaurantRating $restaurantRating)
    {
        $totalRatings=RestaurantRating::where('restaurants_id',$restaurantRating->restaurants_id)->sum('vote');
        $ratingCount=RestaurantRating::where('restaurants_id',$restaurantRating->restaurants_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $restaurant=Restaurant::findOrFail($restaurantRating->restaurants_id);
        $restaurant->average_ratings=number_format($averageRating,1);
        $restaurant->save();
    }

    /**
     * Handle the RestaurantRating "updated" event.
     *
     * @param  \App\Models\RestaurantRating  $restaurantRating
     * @return void
     */
    public function updated(RestaurantRating $restaurantRating)
    {
        //
    }

    /**
     * Handle the RestaurantRating "deleted" event.
     *
     * @param  \App\Models\RestaurantRating  $restaurantRating
     * @return void
     */
    public function deleted(RestaurantRating $restaurantRating)
    {
        //
    }

    /**
     * Handle the RestaurantRating "restored" event.
     *
     * @param  \App\Models\RestaurantRating  $restaurantRating
     * @return void
     */
    public function restored(RestaurantRating $restaurantRating)
    {
        //
    }

    /**
     * Handle the RestaurantRating "force deleted" event.
     *
     * @param  \App\Models\RestaurantRating  $restaurantRating
     * @return void
     */
    public function forceDeleted(RestaurantRating $restaurantRating)
    {
        //
    }
}
