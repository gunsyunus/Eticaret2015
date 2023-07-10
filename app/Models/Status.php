<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders_status';

    /**
     * @var string
     */
    protected $primaryKey = 'id_status';
    
    /**
     * @var boolean
     */
    public $timestamps = false;
}
