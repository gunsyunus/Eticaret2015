<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ProductStock extends Event
{
    use SerializesModels;

    /**
     * Product ID
     *
     * @var integer
     */
    public $product_id;

    /**
     * Product Stock
     *
     * @param  integer $product_id
     * @return void
     */
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
    }
}
