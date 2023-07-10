<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run order status database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['name'                 => 'Garanti',
             'customer_text'        => 'Terminal No',
             'merchant_text'        => 'Üye İşyeri Numarası',
             'username_text'        => '',
             'password_text'        => 'Şifre (ProvUser)',
             'secure_verify_status' => '0',
             'status'               => '0',
            ],
            ['name'                 => 'Akbank',
             'customer_text'        => '',
             'merchant_text'        => 'Mağaza No',
             'username_text'        => 'API Kullanıcı Adı',
             'password_text'        => 'Şifre',
             'secure_verify_status' => '0',
             'status'               => '0',
            ],
            ['name'                 => 'Kuveyttürk',
             'customer_text'        => 'Müşteri Numarası',
             'merchant_text'        => 'Mağaza Kodu',
             'username_text'        => 'API Kullanıcı Adı',
             'password_text'        => 'Şifre',
             'secure_verify_status' => '1',
             'status'               => '0',
            ],
            ['name'                 => 'PayU',
             'customer_text'        => '',
             'merchant_text'        => 'PayU Mağaza Kodu',
             'username_text'        => '',
             'password_text'        => 'PayU Güvenlik Anahtarı',
             'secure_verify_status' => '0',
             'status'               => '0',
            ],

        ];

        Bank::insert($banks);
    }
}
