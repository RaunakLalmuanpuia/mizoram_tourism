<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RestaurantRating;

class RestaurantRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = [
            [
              'restaurants_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
             
          ];
      
          foreach ($restaurants as $restaurant) {
            RestaurantRating::create($restaurant);
          }      }
}
