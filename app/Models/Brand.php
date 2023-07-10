<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'brands';

    /**
     * @var string
     */
    protected $primaryKey = 'id_brand';
    
    /**
     * The brand creates a seo link.
     *
     * @param  string $value
     * @return void
     */
    public function setBnameAttribute($value)
    {
        $this->attributes['bname'] = $value;
        $this->attributes['sef_url'] = str_slug($value);
    }
}
