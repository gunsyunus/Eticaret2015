<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\Setting;
use Image;
use File;

class GalleryController extends PanelController
{
    /**
     * Add a new image to the product image gallery.
     *
     * @param  GalleryRequest $request
     * @return Response
     */
    public function postAdd(GalleryRequest $request)
    {
        $images = $request->file('images');

        $title = substr(str_slug($request->input('name')), 0, 25);

        $setting = Setting::findOrFail(1);
 
        foreach ($images as $upload) {
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $uploadnameSmall = $title.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/product/', $uploadname);
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_big_width, $setting->product_big_height)
                   ->save();
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_small_width, $setting->product_small_height)
                   ->save('media/product/small/'.$uploadnameSmall);
            $gallery = new Gallery;
            $gallery->product_id = $request->input('product_id');
            $gallery->image_small = 'media/product/small/'.$uploadnameSmall;
            $gallery->image_big = 'media/product/'.$uploadname;
            $gallery->save();
        }

        if ($gallery->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Resim başarıyla eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Delete image from gallery.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $gallery = Gallery::findOrFail($id);
        File::delete($gallery->image_small);
        File::delete($gallery->image_big);
        $gallery->delete();

        if (!$gallery->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Resim başarıyla silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
