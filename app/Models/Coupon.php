<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var string
     */
    protected $primaryKey = 'id_coupon';
}
