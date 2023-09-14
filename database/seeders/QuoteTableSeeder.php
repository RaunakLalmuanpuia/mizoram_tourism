<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;

class QuoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotes = [
            [
                'district_meta_data_id' => '1',
                'quote' => 'Lorem ipsum dolor sit amet, consect elit, sed do eiusmod tna aliqua. Ut enim ad minim ',
                
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ];

        foreach($quotes as $quote){
            Quote::create($quote);
        }
    }
}
