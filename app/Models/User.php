<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @var string
     */
    protected $table = 'users_a';

    /**
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * @var string
     */
    protected $appends = ['full_name'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Password Hash
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * User Fullname
     *
     * @param string $value
     */
    public function getFullnameAttribute($value)
    {
        return $this->name.' '.$this->surname;
    }
}
