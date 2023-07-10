<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var string
     */
    protected $primaryKey = 'id_page';

    /**
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * The page creates a seo link.
     * 
     * @param  string $value
     * @return void
     */    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['sef_url'] = str_slug($value);
    }
}
