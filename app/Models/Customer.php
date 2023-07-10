<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var string
     */
    protected $primaryKey = 'id_customer';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Customer birthday date format
     *
     * @param  string $value
     * @return void
     */
    public function setBirthAtAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['birth_at'] = '0000-00-00';
        } else {
            $date = explode('.', $value);
            $this->attributes['birth_at'] = $date[2].'-'.$date[1].'-'.$date[0];
        }
    }

    /**
     * @return array
     */
    public function getDates()
    {
        return array('login_at','order_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id_user');
    }
}
