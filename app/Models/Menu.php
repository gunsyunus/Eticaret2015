<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var string
     */
    protected $primaryKey = 'id_menu';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
