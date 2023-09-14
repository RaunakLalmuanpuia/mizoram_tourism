<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentRating;

class AgentRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = [
            [
              'agents_id' => 1,
              'user_id' => 1,
              'vote' => '1',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
              'agents_id' => 1,
              'user_id' => 1,
              'vote' => '3',
              'review' => 'My Review',
              
              'created_at' => date("Y-m-d H:i:s"),
            ],
             
          ];
      
          foreach ($agents as $agent) {
            AgentRating::create($agent);
          }
    }
}
