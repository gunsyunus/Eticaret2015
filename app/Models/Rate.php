<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * @var string
     */
    protected $table = 'rates';

    /**
     * @var string
     */
    protected $primaryKey = 'id_rate';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
