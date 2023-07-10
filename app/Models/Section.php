<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * @var string
     */
    protected $table = 'pages_section';

    /**
     * @var string
     */
    protected $primaryKey = 'id_section';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
