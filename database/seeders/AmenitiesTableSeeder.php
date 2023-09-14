<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $amenities = [
      [
        'name' => 'Wifi',
        'logo' => 'logo link',
        'created_at' => date("Y-m-d H:i:s"),
      ],
      [
        'name' => 'Parking',
        'logo' => 'logo link',
        'created_at' => date("Y-m-d H:i:s"),
      ],
      [
        'name' => 'Television',
        'logo' => 'logo link',
        'created_at' => date("Y-m-d H:i:s"),
      ],
      [
        'name' => 'Gym',
        'logo' => 'logo link',
        'created_at' => date("Y-m-d H:i:s"),
      ],
      [
        'name' => 'Courtyard',
        'logo' => 'logo link',
        'created_at' => date("Y-m-d H:i:s"),
      ]
    ];

    foreach ($amenities as $amenity) {
      Amenity::create($amenity);
    }
  }
}
