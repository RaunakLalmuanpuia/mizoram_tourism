<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Festival;

class FestivalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $festivals = [
            [
              'name' => 'Chapchar Kut',
              'date' => '25th Nov',

              'description' => 'In the festival seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',

              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Krismas',
                'date' => '25th Dec',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Coffee Nite',
                'date' => '25th Nov',
                'created_at' => date("Y-m-d H:i:s"),
            ],
          
          ];
      
          foreach ($festivals as $festival) {
            Festival::create($festival);
          }
    }
}
