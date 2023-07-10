<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class FooterMenu extends Event
{
    use SerializesModels;

    /**
     * Footer model variable
     *
     * @var array
     */
    public $footer;

    /**
     * Footer Menu
     *
     * @param  array $footer
     * @return void
     */
    public function __construct($footer)
    {
        $this->footer = $footer;
    }
}
