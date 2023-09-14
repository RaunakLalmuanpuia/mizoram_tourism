<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;

class GuestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guests = [
            [
              'first_name' => 'Thanga',
              'last_name' => 'Sailo',
              'email' => 'thang@mail.com',
              'phone' => '876869878',
              'users_id' => 1,

              'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'first_name' => 'Tea',
                'last_name' => 'Railo',
                'email' => 'Rai@mail.com',
                'phone' => '9876567987',
                'users_id' => 1,
  
                'created_at' => date("Y-m-d H:i:s"),
            ],
        
          
          ];
      
          foreach ($guests as $guest) {
            Guest::create($guest);
          }
    }
}
