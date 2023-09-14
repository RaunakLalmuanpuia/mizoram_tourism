<?php

namespace app\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\AgentRating;
use App\Models\GuideRating;
use App\Models\HotelRating;
use App\Models\LodgeRating;
use App\Models\Operator;
use App\Models\OperatorRating;
use App\Models\RentalRating;
use App\Models\RestaurantRating;
use App\Observers\AgentRatingObserver;
use App\Observers\GuideRatingObserver;
use App\Observers\HotelRatingObserver;
use App\Observers\LodgeRatingObserver;
use App\Observers\OperatorRatingObserver;
use App\Observers\RentalRatingObserver;
use App\Observers\RestaurantRatingObserver;
use App\Repositories\AmenityRepository;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    AgentRating::observe(AgentRatingObserver::class);
    HotelRating::observe(HotelRatingObserver::class);
    GuideRating::observe(GuideRatingObserver::class);
    OperatorRating::observe(OperatorRatingObserver::class);
    RentalRating::observe(RentalRatingObserver::class);
    RestaurantRating::observe(RestaurantRatingObserver::class);
    LodgeRating::observe(LodgeRatingObserver::class);

    Schema::defaultStringLength(191);
  }
}
