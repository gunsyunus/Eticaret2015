<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Image;
use File;

class BannerBrandController extends PanelController
{
    /**
     * Homepage brand logos list.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banners = Banner::where('type', '=', 'home_brand')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.bannerBrand.index', compact('banners'));
    }

    /**
     * New brand logo.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.bannerBrand.new');
    }

    /**
     * Add brand logo.
     *
     * @param  BannerRequest $request
     * @return Response
     */
    public function postAdd(BannerRequest $request)
    {
        $banner = new Banner;
        $banner->title = $request->input('title');
        $banner->status = ($request->input('status')=='1') ? '1' : '0';
        $banner->url = $request->input('url');
        $banner->sort = $request->input('sort');
        $banner->type = 'home_brand';

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/brand/', $uploadname);
            Image::make('media/brand/'.$uploadname)->resize(135, 50)->save();
            $banner->image = 'media/brand/'.$uploadname;
        }

        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Logo eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit brand logo.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banners = Banner::where('id_banner', '=', $id)->where('type', '=', 'home_brand')->firstOrFail();
        return view('panel.module.bannerBrand.edit', compact('banners'));
    }

    /**
     * Update brand logo.
     *
     * @param  BannerRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(BannerRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->title = $request->input('title');
        $banner->status = ($request->input('status')=='1') ? '1' : '0';
        $banner->url = $request->input('url');
        $banner->sort = $request->input('sort');

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($banner->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/brand/', $uploadname);
            Image::make('media/brand/'.$uploadname)->resize(135, 50)->save();
            $banner->image = 'media/brand/'.$uploadname;
        }
        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Logo güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete brand logo.
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
                                      'alertMessage'=>'Logo silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
