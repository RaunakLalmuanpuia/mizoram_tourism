<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;

class AgentSeeder extends Seeder
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
              'name' => 'Agent 1',
              'license' => 'ADFDDE3',
              'address' => 'Zarkawt',
              'district_meta_data_id' => '1',
              'phone_one' => '9654367283',
              'phone_two' => '7889997662',
              'email' => 'john@mail.com',
              'description' => ' seeder class only contains one method by default: run. This method is called when the db:seed Artisan command is executed. Within the run method, you may insert data into your database ',
              'created_at' => date("Y-m-d H:i:s"),
            ],
             
          ];
      
          foreach ($agents as $agent) {
            Agent::create($agent);
          }
    }
}
