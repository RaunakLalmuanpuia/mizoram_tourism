<?php

namespace App\Providers;


use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;

use App\Interfaces\AmenityRepositoryInterface;
use App\Repositories\AmenityRepository;

use App\Interfaces\DistrictMetaDataRepositoryInterface;
use App\Repositories\DistrictMetaDataRepository;

use App\Interfaces\DistrictTopDestinationRepositoryInterface;
use App\Repositories\DistrictTopDestinationRepository;

use App\Interfaces\LodgeRepositoryInterface;
use App\Repositories\LodgeRepository;

use App\Interfaces\LodgeRoomTypeRepositoryInterface;
use App\Repositories\LodgeRoomTypeRepository;

use App\Interfaces\LodgeRoomDataRepositoryInterface;
use App\Repositories\LodgeRoomDataRepository;

use App\Interfaces\QuoteRepositoryInterface;
use App\Repositories\QuoteRepository;

use App\Interfaces\UserBookingRepositoryInterface;
use App\Repositories\UserBookingRepository;

use App\Interfaces\ReportRepositoryInterface;
use App\Repositories\ReportRepository;

use App\Interfaces\TagRepositoryInterface;
use App\Repositories\TagRepository;

use App\Interfaces\GuideRepositoryInterface;
use App\Repositories\GuideRepository;

use App\Interfaces\HotelRepositoryInterface;
use App\Repositories\HotelRepository;

use App\Interfaces\RestaurantRepositoryInterface;
use App\Repositories\RestaurantRepository;

use App\Interfaces\OperatorRepositoryInterface;
use App\Repositories\OperatorRepository;

use App\Interfaces\RentalRepositoryInterface;
use App\Repositories\RentalRepository;

use App\Interfaces\AgentRepositoryInterface;
use App\Repositories\AgentRepository;

use App\Interfaces\DistanceRepositoryInterface;
use App\Repositories\DistanceRepository;

use App\Interfaces\FestivalRepositoryInterface;
use App\Repositories\FestivalRepository;

use App\Interfaces\AboutRepositoryInterface;
use App\Repositories\AboutRepository;

use App\Interfaces\InformationRepositoryInterface;
use App\Repositories\InformationRepository;

use App\Interfaces\GuestRepositoryInterface;
use App\Repositories\GuestRepository;

use App\Interfaces\NoticeRepositoryInterface;
use App\Repositories\NoticeRepository;

use App\Interfaces\HiringRepositoryInterface;
use App\Repositories\HiringRepository;

use App\Interfaces\MizoramRepositoryInterface;
use App\Repositories\MizoramRepository;

use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;

use App\Interfaces\IndexRepositoryInterface;
use App\Repositories\IndexRepository;

use App\Interfaces\OperatorRatingRepositoryInterface;
use App\Repositories\OperatorRatingRepository;

use App\Interfaces\LodgeRatingRepositoryInterface;
use App\Repositories\LodgeRatingRepository;

use App\Interfaces\GuideRatingRepositoryInterface;
use App\Repositories\GuideRatingRepository;

use App\Interfaces\AgentRatingRepositoryInterface;
use App\Repositories\AgentRatingRepository;

use App\Interfaces\RentalRatingRepositoryInterface;
use App\Repositories\RentalRatingRepository;

use App\Interfaces\RestaurantRatingRepositoryInterface;
use App\Repositories\RestaurantRatingRepository;

use App\Interfaces\HotelRatingRepositoryInterface;
use App\Repositories\HotelRatingRepository;

use App\Interfaces\PledgeRepositoryInterface;
use App\Repositories\PledgeRepository;

use App\Interfaces\OccupancyRepositoryInterface;
use App\Repositories\OccupancyRepository;

use App\Interfaces\OccupancyDetailRepositoryInterface;
use App\Repositories\OccupancyDetailRepository;

use App\Interfaces\CarousalRepositoryInterface;
use App\Repositories\CarousalRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(AmenityRepositoryInterface::class, AmenityRepository::class);
        $this->app->bind(DistrictMetaDataRepositoryInterface::class, DistrictMetaDataRepository::class);
        $this->app->bind(DistrictTopDestinationRepositoryInterface::class, DistrictTopDestinationRepository::class);
        $this->app->bind(LodgeRepositoryInterface::class, LodgeRepository::class);
        $this->app->bind(LodgeRoomTypeRepositoryInterface::class, LodgeRoomTypeRepository::class);
        $this->app->bind(LodgeRoomDataRepositoryInterface::class, LodgeRoomDataRepository::class);
        $this->app->bind(QuoteRepositoryInterface::class, QuoteRepository::class);
        $this->app->bind(UserBookingRepositoryInterface::class, UserBookingRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);

        $this->app->bind(GuideRepositoryInterface::class, GuideRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(RestaurantRepositoryInterface::class, RestaurantRepository::class);
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(RentalRepositoryInterface::class, RentalRepository::class);
        $this->app->bind(AgentRepositoryInterface::class, AgentRepository::class);
        $this->app->bind(DistanceRepositoryInterface::class, DistanceRepository::class);
        $this->app->bind(FestivalRepositoryInterface::class, FestivalRepository::class);

        $this->app->bind(AboutRepositoryInterface::class, AboutRepository::class);
        $this->app->bind(InformationRepositoryInterface::class, InformationRepository::class);
        $this->app->bind(GuestRepositoryInterface::class, GuestRepository::class);
        $this->app->bind(NoticeRepositoryInterface::class, NoticeRepository::class);
        $this->app->bind(HiringRepositoryInterface::class, HiringRepository::class);
        $this->app->bind(MizoramRepositoryInterface::class, MizoramRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(IndexRepositoryInterface::class, IndexRepository::class);

        $this->app->bind(OperatorRatingRepositoryInterface::class, OperatorRatingRepository::class);
        $this->app->bind(LodgeRatingRepositoryInterface::class, LodgeRatingRepository::class);
        $this->app->bind(GuideRatingRepositoryInterface::class, GuideRatingRepository::class);
        $this->app->bind(AgentRatingRepositoryInterface::class, AgentRatingRepository::class);
        $this->app->bind(RentalRatingRepositoryInterface::class, RentalRatingRepository::class);
        $this->app->bind(RestaurantRatingRepositoryInterface::class, RestaurantRatingRepository::class);
        $this->app->bind(HotelRatingRepositoryInterface::class, HotelRatingRepository::class);

        $this->app->bind(PledgeRepositoryInterface::class, PledgeRepository::class);
        $this->app->bind(UserRequestRepositoryInterface::class, UserRequestRepository::class);
        $this->app->bind(OccupancyRepositoryInterface::class, OccupancyRepository::class);
        $this->app->bind(OccupancyDetailRepositoryInterface::class, OccupancyDetailRepository::class);
        $this->app->bind(CarousalRepositoryInterface::class, CarousalRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
