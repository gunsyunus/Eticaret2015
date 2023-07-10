<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankRateGroup extends Model
{
    /**
     * @var string
     */
    protected $table = 'banks_rate_group';

    /**
     * @var string
     */
    protected $primaryKey = 'id_group';
}
