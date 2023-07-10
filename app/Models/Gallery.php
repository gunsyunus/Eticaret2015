<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * @var string
     */
    protected $table = 'products_gallery';

    /**
     * @var string
     */
    protected $primaryKey = 'id_gallery';

    /**
     * @var boolean
     */
    public $timestamps = false;
}
