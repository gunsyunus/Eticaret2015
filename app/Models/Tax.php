<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    /**
     * @var string
     */
    protected $table = 'taxs';

    /**
     * @var string
     */
    protected $primaryKey = 'id_tax';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
