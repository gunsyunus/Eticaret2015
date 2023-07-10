<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankRate extends Model
{
    /**
     * @var string
     */
    protected $table = 'banks_rate';

    /**
     * @var string
     */
    protected $primaryKey = 'id_rate';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\BankRateGroup', 'group_id', 'id_group');
    }
}
