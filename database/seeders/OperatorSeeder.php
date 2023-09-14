<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operator;

class OperatorSeeder extends Seeder
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
              'name' => 'Operator 1',
              'license' => 'ADFDDE3',
              'address' => 'Zarkawt',
              'district_meta_data_id' => 1,
              'phone_one' => '9654367283',
              'phone_two' => '7889997662',
              'email' => 'john@mail.com',
              'description' => ' seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',

              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Operator 2',
                'license' => 'ADFDDE3',
                'address' => 'Electric Veng',
                'district_meta_data_id' => 1,
                'phone_one' => '9776367283',
                'phone_two' => '9000997662',
                'email' => 'irene@mail.com',
                'description' => ' seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',
  
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Operator 3',
                'license' => 'ADFDDE3',
                'address' => 'Bazar Veng',
                'district_meta_data_id' => 2,
                'phone_one' => '9978987283',
                'phone_two' => '8088997662',
                'email' => 'siama@mail.com',
                'description' => ' seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',
  
                'created_at' => date("Y-m-d H:i:s"),
            ],
          
          ];
      
          foreach ($operators as $operator) {
            Operator::create($operator);
          } 
    }
}
