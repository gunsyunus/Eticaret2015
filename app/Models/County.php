<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    /**
     * @var string
     */
    protected $table = 'counties';

    /**
     * @var string
     */
    protected $primaryKey = 'id_county';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id_city');
    }
}
