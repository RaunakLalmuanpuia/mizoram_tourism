<?php

namespace Database\Seeders;

use App\Models\DistrictTopDestination;
use Illuminate\Database\Seeder;

class DistrictTopDestinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $district_top_destinations=[
            [
                'district_meta_data_id' => 1,
                'destination_name' => 'City Park',
                'distance' => '777km',
                'latitude' => '23.727106',
                'longitude' => '92.717636',
                'destination_banner' => 'https://content3.jdmagicbox.com/comp/aizawl/g5/9999px389.x389.170605122501.l1g5/catalogue/folkland-park-aizawl-0k5wmrvhy7.jpeg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'district_meta_data_id' => 1,
                'destination_name' => 'Millenium Center',
                'distance' => '777km',
                'latitude' => '23.727106',
                'longitude' => '92.717636',
                'destination_banner' => 'https://live.staticflickr.com/8631/16516079609_da389affc6_b.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'district_meta_data_id' => 1,
                'destination_name' => 'Museum',
                'distance' => '777km',
                'latitude' => '23.727106',
                'longitude' => '92.717636',
                'destination_banner' => 'https://mizoculture.mizoram.gov.in/uploads/attachments/f7bd5306047d09f93657ecde394fe11c/dsc-5635.JPG',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'created_at' => date("Y-m-d H:i:s"),
            ],

        ];

        foreach($district_top_destinations as $district_top_destination){
            DistrictTopDestination::create($district_top_destination);
        } 
    }
}
