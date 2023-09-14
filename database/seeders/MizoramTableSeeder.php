<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mizoram;

class MizoramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mizorams = [
            [
                'name' => 'Mizoram',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'image' => 'link',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];

        foreach($mizorams as $mizoram){
            Mizoram::create($mizoram);
        }
    }
}
