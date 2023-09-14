<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Distance;

class DistanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $distances = [
            [
              'means' => 'Air',
              'description' => 'In the air seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',

              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'means' => 'Sea',
                'description' => 'By sea we seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',
  
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'means' => 'Road',
                'description' => 'By road seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',
  
                'created_at' => date("Y-m-d H:i:s"),
            ],
          
          ];
      
          foreach ($distances as $distance) {
            Distance::create($distance);
          }
    }
}
