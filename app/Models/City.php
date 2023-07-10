<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * @var string
     */
    protected $primaryKey = 'id_city';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
