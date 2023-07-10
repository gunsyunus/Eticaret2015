<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserLog extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_log';

    /**
     * @var string
     */
    protected $primaryKey = 'id_log';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['process_text'];

    /**
     * @return array
     */
    public function getDates()
    {
        return array('process_at');
    }
}
