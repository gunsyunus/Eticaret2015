<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerElement extends Model
{
    /**
     * @var string
     */
    protected $table = 'banners_element';

    /**
     * @var string
     */
    protected $primaryKey = 'id_element';

    /**
     * @var array
     */
    public static $rules = ['name'=>'required'];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
