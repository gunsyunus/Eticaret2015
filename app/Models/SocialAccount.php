<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    /**
     * @var string
     */
    protected $table = 'users_social_account';

    /**
     * @var string
     */
    protected $primaryKey = 'id_account';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id_user');
    }
}
