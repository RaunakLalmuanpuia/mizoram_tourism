<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags =[
            [
                'name' => 'Hiking',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Fishing',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Sightseeing',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Fishing',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Walking',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];

        foreach($tags as $tag){
            Tag::create($tag);
        }
    }
}
