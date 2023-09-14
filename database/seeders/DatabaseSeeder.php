<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
 

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(UserTableSeeder::class);
    $this->call(AmenitiesTableSeeder::class);
    $this->call(DistrictMetadataTableSeeder::class);
    $this->call(DistrictTopDestinationTableSeeder::class);
    $this->call(LodgeRoomTypeTableSeeder::class);
    $this->call(LodgeTableSeeder::class);
    $this->call(LodgeRoomDataTableSeeder::class);
    $this->call(MizoramTableSeeder::class);
    $this->call(TagTableSeeder::class);
    $this->call(ImageTableSeeder::class);
    $this->call(DestinationsTagsTableSeeder::class);
    $this->call(QuoteTableSeeder::class);
 
    $this->call(AgentSeeder::class);
    $this->call(GuideSeeder::class);
    $this->call(HotelSeeder::class);
    $this->call(OperatorSeeder::class);
    $this->call(RentalSeeder::class);
    $this->call(RestaurantSeeder::class);
    $this->call(DistanceTableSeeder::class);
    $this->call(FestivalTableSeeder::class);

    $this->call(AboutTableSeeder::class);
    $this->call(InformationTableSeeder::class);
    $this->call(GuestTableSeeder::class);
    $this->call(NoticeCategoryTableSeeder::class);

    $this->call(NoticeTableSeeder::class);
    $this->call(HiringTableSeeder::class);
    $this->call(IndexTableSeeder::class);

    $this->call(AgentRatingTableSeeder::class);
    $this->call(GuideRatingTableSeeder::class);
    $this->call(HotelRatingTableSeeder::class);
    $this->call(LodgeRatingTableSeeder::class);
    $this->call(OperatorRatingTableSeeder::class);
    $this->call(RentalRatingTableSeeder::class);
    $this->call(RestaurantRatingTableSeeder::class);

    $this->call(PledgeTableSeeder::class);
 
  }
}
