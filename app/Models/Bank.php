<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * @var string
     */
    protected $table = 'banks';

    /**
     * @var string
     */
    protected $primaryKey = 'id_bank';
}
