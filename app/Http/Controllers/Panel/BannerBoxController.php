<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Image;
use File;

class BannerBoxController extends PanelController
{
    /**
     * List the advertising banners.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banners = Banner::where('type', '=', 'home_box')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.bannerBox.index', compact('banners'));
    }

    /**
     * Create a banner for the advertisement slot.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.bannerBox.new');
    }

    /**
     * Add advertisement banner.
     *
     * @param  BannerRequest $request
     * @return Response
     */
    public function postAdd(BannerRequest $request)
    {
        $bannerBox = new Banner;
        $bannerBox->title = $request->input('title');
        $bannerBox->status = ($request->input('status')=='1') ? '1' : '0';
        $bannerBox->url = $request->input('url');
        $bannerBox->sort = $request->input('sort');
        $bannerBox->type = 'home_box';

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(275, 320)->save();
            $bannerBox->image = 'media/other/'.$uploadname;
        }

        $bannerBox->save();

        if ($bannerBox->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kutu banner eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Update your advertising banner.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banners = Banner::where('id_banner', '=', $id)->where('type', '=', 'home_box')->firstOrFail();
        return view('panel.module.bannerBox.edit', compact('banners'));
    }

    /**
     * Update your advertising banner.
     *
     * @param  BannerRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(BannerRequest $request, $id)
    {
        $bannerBox = Banner::findOrFail($id);
        $bannerBox->title = $request->input('title');
        $bannerBox->status = ($request->input('status')=='1') ? '1' : '0';
        $bannerBox->url = $request->input('url');
        $bannerBox->sort = $request->input('sort');

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($bannerBox->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(275, 320)->save();
            $bannerBox->image = 'media/other/'.$uploadname;
        }
        $bannerBox->save();

        if ($bannerBox->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kutu banner güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete advertising banner.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $banner = Banner::findOrFail($id);
        File::delete($banner->image);
        $banner->delete();

        if (!$banner->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kutu banner silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
