<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LodgeRoomType;

class LodgeRoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lodgeRoomType = [
            [
                'name' => 'Penthouse',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Single Delux',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Double Delux',
                'created_at' => date("Y-m-d H:i:s"),
            ],
           

        ];

        foreach($lodgeRoomType as $lodge){
            LodgeRoomType::create($lodge);
        }
    }
}
