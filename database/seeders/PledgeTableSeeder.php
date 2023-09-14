<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pledge;

class PledgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pledges = [
            [
              'user_id' => 1,
          
              'created_at' => date("Y-m-d H:i:s"),
            ],
            
          ];
      
          foreach ($pledges as $pledge) {
            Pledge::create($pledge);
          }     }
}
