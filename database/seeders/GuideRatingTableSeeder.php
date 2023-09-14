<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuideRating;

class GuideRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guides = [
            [
              'guides_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
             
          ];
      
          foreach ($guides as $guide) {
            GuideRating::create($guide);
          }  
    }
}
