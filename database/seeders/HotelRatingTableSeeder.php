<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelRating;

class HotelRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotels = [
            [
              'hotels_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
             
          ];
      
          foreach ($hotels as $hotel) {
            HotelRating::create($hotel);
          }  
    }
}
