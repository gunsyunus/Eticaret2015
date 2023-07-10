<?php

use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ShipmentTableSeeder extends Seeder
{
    /**
     * Run shipment database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipments = [
            ['name'                 => 'Yurtiçi Kargo',
             'provider_name'        => 'Yurtiçi',
             'provider_service_url' => 'http://selfservis.yurticikargo.com/reports/SSWDocumentDetail.aspx?DocId=',
             'sort'                 => '1',
             'status'               => '1',
            ],
            ['name'                 => 'Aras Kargo',
             'provider_name'        => 'Aras',
             'provider_service_url' => 'http://kargotakip.araskargo.com.tr/CargoInfoV3.aspx?code=',
             'sort'                 => '2',
             'status'               => '1',
            ],
            ['name'                 => 'Sürat Kargo',
             'provider_name'        => 'Tanımsız',
             'provider_service_url' => '',
             'sort'                 => '3',
             'status'               => '1',
             ],
            ['name'                 => 'MNG Kargo',
             'provider_name'        => 'MNG',
             'provider_service_url' => 'http://service.mngkargo.com.tr/iactive/popup/kargotakip.asp?k=',
             'sort'                 => '4',
             'status'               => '1',
            ],
        ];

        Shipment::insert($shipments);
    }
}
