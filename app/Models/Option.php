<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'products_option';

    /**
     * @var string
     */
    protected $primaryKey = 'id_option';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
