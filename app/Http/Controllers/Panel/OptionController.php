<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\OptionRequest;
use App\Models\Option;
use App\Models\Product;
use App\Events\ProductStock;

class OptionController extends PanelController
{
    /**
     * It creates sub-options for the product.
     * 
     * Shoe size, t-shirt body, dress color etc...
     *
     * @param  OptionRequest $request
     * @return Response
     */
    public function postAdd(OptionRequest $request)
    {
        $option = new Option;
        $option->name = $request->input('name');
        $option->code = $request->input('code');
        $option->price = $request->input('price');
        $option->stock = $request->input('stock');
        $option->product_id = $request->input('product_id');
        $option->save();

        event(new ProductStock($option->product_id));

        if ($option->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Seçenek eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Update option.
     *
     * @param  OptionRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(OptionRequest $request, $id)
    {
        $option = Option::findOrFail($id);
        $option->name = $request->input('name');
        $option->code = $request->input('code');
        $option->price = $request->input('price');
        $option->stock = $request->input('stock');
        $option->save();

        event(new ProductStock($option->product_id));

        if ($option->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Seçenek güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete option.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();

        event(new ProductStock($option->product_id));

        if (!$option->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Seçenek silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
