<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    /**
     * @var string
     */
    protected $table = 'shipments';

    /**
     * @var string
     */
    protected $primaryKey = 'id_shipment';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
