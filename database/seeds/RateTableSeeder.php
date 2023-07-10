<?php

use Illuminate\Database\Seeder;
use App\Models\Rate;

class RateTableSeeder extends Seeder
{
    /**
     * Run product rate database seeds.
     *
     * @return void
     */    
    public function run()
    {
        $rates = [
            ['name' => 'TL'   ,'amount' => '0.0000'],
            ['name' => 'USD'  ,'amount' => '3.5000'],
            ['name' => 'EURO' ,'amount' => '3.7000'],
        ];

        Rate::insert($rates);
    }
}
