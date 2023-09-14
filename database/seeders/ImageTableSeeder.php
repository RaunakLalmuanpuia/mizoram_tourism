<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images=[
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 1,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/mill-mountain_ARAGQYVAYC.jpg',
                'alt' => 'House By Lake',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 1,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/sea-ocean_EP88PX3IST.jpg',
                'alt' => 'Sunset',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 2,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/bridge-structure_5Z56VEKLQY.jpg',
                'alt' => 'Bridge',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 2,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/trees-plant_WUB1QV1JCC.jpg',
                'alt' => 'Forest',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 3,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/flower-white_8I4ATM3V9B.jpg',
                'alt' => 'Flower Girl',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 3,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/person-crowd_GPNIAH9UKW.jpg',
                'alt' => 'Crowd',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictTopDestination',
                'model_id' => 1,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/fireworks-celebration_UEQ7SBHDQ0.jpg',
                'alt' => 'Fireworks',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictMetaData',
                'model_id' => 1,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/city%20lights-buildings_YP7B573GOA.jpg',
                'alt' => 'City 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictMetaData',
                'model_id' => 3,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/fireworks-celebration_UEQ7SBHDQ0.jpg',
                'alt' => 'City 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'model' => 'DistrictMetaData',
                'model_id' => 2,
                'name' => 'https://cdn.stocksnap.io/img-thumbs/960w/building-perspective_ADXWJK5WNS.jpg',
                'alt' => 'City 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          
                'created_at' => date("Y-m-d H:i:s"),
            ],

        ];

        foreach($images as $image){
            Image::create($image);
        }
    }
}
