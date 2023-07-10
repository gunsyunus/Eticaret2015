<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    /**
     * @var string
     */
    protected $table = 'designs';

    /**
     * @var string
     */
    protected $primaryKey = 'id_design';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
