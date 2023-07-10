<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    /**
     * @var string
     */
    protected $table = 'menus_footer';

    /**
     * @var string
     */
    protected $primaryKey = 'id_menu';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
