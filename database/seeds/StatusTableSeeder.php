<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run order status database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Yeni',         'sort' => '10', 'color' => 'primary'],
            ['name' => 'Hazırlanıyor', 'sort' => '20', 'color' => 'info'],
            ['name' => 'Kargo',        'sort' => '30', 'color' => 'warning'],
            ['name' => 'Tamamlandı',   'sort' => '40', 'color' => 'success'],
            ['name' => 'Iptal',        'sort' => '50', 'color' => 'danger'],
        ];

        Status::insert($statuses);
    }
}
