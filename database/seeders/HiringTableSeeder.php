<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hiring;

class HiringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            [
                'type' => 'Vehicle below 7 lakhs',

              'minimum_charge' => '1000',
              'rate_per_km' => '25',
              'rate_per_hour' => '300',
              'halt' => '1000',
              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'type' => 'Vehicle 7 lakhs & above but below 12 lakhs',
              'minimum_charge' => '1800',
              'rate_per_km' => '30',
              'rate_per_hour' => '350',
              'halt' => '1200',
              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'type' => 'Vehicle 12 lakhs & above but below 17 lakhs',
                'minimum_charge' => '2000',
                'rate_per_km' => '35',
                'rate_per_hour' => '400',
                'halt' => '700',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'type' => 'Vehicle 17 lakhs & above',
                'minimum_charge' => '3500',
                'rate_per_km' => '45',
                'rate_per_hour' => '700',
                'halt' => '1800',
                'created_at' => date("Y-m-d H:i:s"),
            ],
          ];
      
          foreach ($rates as $rate) {
            Hiring::create($rate);
          }   
    }
}
