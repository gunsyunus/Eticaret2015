<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerElementRequest;
use App\Models\BannerElement;
use File;

class BannerElementController extends PanelController
{
    /**
     * Add custom elements to the main banner.
     * 
     * Elements: Text, image and video with effect.
     *
     * @param  BannerElementRequest $request [description]
     * @return Response
     */
    public function postAdd(BannerElementRequest $request)
    {
        $element = new BannerElement;
        $element->name = $request->input('name');
        $element->type = $request->input('type');
        $element->banner_id = $request->input('banner_id');
        $element->save();

        if ($element->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Element eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Update the banner element.
     *
     * @param  BannerElementRequest $request
     * @param  int                  $id
     * @return Response
     */
    public function postSave(BannerElementRequest $request, $id)
    {
        $element = BannerElement::findOrFail($id);
        $element->name = $request->input('name');
        $element->xleft = $request->input('xleft');
        $element->xtop = $request->input('xtop');
        $element->bg_color = $request->input('bg_color');
        $element->text_color = $request->input('text_color');
        $element->effect = $request->input('effect');
        $element->effect_delay = $request->input('effect_delay');
        $element->text = $request->input('text');
        $element->video_url = $request->input('video_url');
        $element->delay = $request->input('delay');
        $element->text_size = $request->input('text_size');

        $title = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($element->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            $element->image = 'media/other/'.$uploadname;
        }
        $element->save();

        if ($element->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Element güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the banner element.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $element = BannerElement::findOrFail($id);
        File::delete($element->image);
        $element->delete();

        if (!$element->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Element silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
