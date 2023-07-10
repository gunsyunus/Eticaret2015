<?php

namespace App\Listeners;

use App\Events\ProductStock;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Option;
use App\Models\Product;

class StockSumUpdate
{
    /**
     * If the product options are processed, sum and update the stock.
     *
     * @param  ProductStock  $event
     * @return void
     */
    public function handle(ProductStock $event)
    {
        $product = Product::findOrFail($event->product_id);
        $product->stock = Option::where('product_id', '=', $product->id_product)->sum('stock');
        $product->save();
    }
}
