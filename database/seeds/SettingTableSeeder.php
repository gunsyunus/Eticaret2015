<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run setting database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['title'              => 'E-Ticaret',
                        'keyword'             => 'e-ticaret,online satış',
                        'description'         => 'Elektronik ticaret, ticari işlemlerden biri veya 
                                                  tamamının elektronik ortamda gerçekleştirilmesi yoluyla...',
                        'copyright'           => '2017 E-Ticaret',
                        'welcome_msg'         => 'Elektronik Ticaretin Gerçek Adresi',
                        'agreement_order_url' => 'satis-sozlesmesi',]);
    }
}
