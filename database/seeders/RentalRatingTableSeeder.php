<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentalRating;

class RentalRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rentals = [
            [
              'rentals_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
             
          ];
      
          foreach ($rentals as $rental) {
            RentalRating::create($rental);
          }  
    }
}
