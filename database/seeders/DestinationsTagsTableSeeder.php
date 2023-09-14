<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DistrictTopDestinationTag;

class DestinationsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinationsTags=[
            [
                'district_top_destinations_id'=> 1,
                'tags_id'=>1
            ],
      
        ];

        foreach($destinationsTags as $destinationsTag){
            DistrictTopDestinationTag::create($destinationsTag);
        }
    }
}
