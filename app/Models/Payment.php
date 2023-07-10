<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders_payment';

    /**
     * @var string
     */
    protected $primaryKey = 'id_payment';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
