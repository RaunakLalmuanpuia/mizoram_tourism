<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OperatorRating;

class OperatorRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operators = [
            [
              'operators_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
             
          ];
      
          foreach ($operators as $operator) {
            OperatorRating::create($operator);
          }  
    }
}
