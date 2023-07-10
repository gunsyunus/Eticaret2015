<?php

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run order payment database seeds.
     *
     * @return void
     */    
    public function run()
    {
        $payments = [
            ['name' => 'Kredi Kartı',        'sort' => '1', 'status' => '0'],
            ['name' => 'Kapıda Nakit',       'sort' => '2', 'status' => '1'],
            ['name' => 'Kapıda Kredi Kartı', 'sort' => '3', 'status' => '0'],
            ['name' => 'Havale',             'sort' => '4', 'status' => '1'],
            ['name' => 'PTT - Posta Çeki',   'sort' => '5', 'status' => '0'],
        ];

        Payment::insert($payments);
    }
}
