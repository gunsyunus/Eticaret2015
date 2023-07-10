<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Image;
use File;

class BannerSubController extends PanelController
{
    /**
     * Homepage sub creative banner.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banners = Banner::where('type', '=', 'home_sub')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.bannerSub.index', compact('banners'));
    }

    /**
     * New banner.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.bannerSub.new');
    }

    /**
     * Add banner.
     *
     * @param  BannerRequest $request
     * @return Response
     */
    public function postAdd(BannerRequest $request)
    {
        $bannerSub = new Banner;
        $bannerSub->title = $request->input('title');
        $bannerSub->status = ($request->input('status')=='1') ? '1' : '0';
        $bannerSub->url = $request->input('url');
        $bannerSub->sort = $request->input('sort');
        $bannerSub->text = $request->input('text');
        $bannerSub->type = 'home_sub';

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-SB'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(242, 162)->save();
            $bannerSub->image = 'media/other/'.$uploadname;
        }

        $bannerSub->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Alt banner eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit banner.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banners = Banner::where('id_banner', '=', $id)->where('type', '=', 'home_sub')->firstOrFail();
        return view('panel.module.bannerSub.edit', compact('banners'));
    }

    /**
     * Update banner.
     *
     * @param  BannerRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(BannerRequest $request, $id)
    {
        $bannerSub = Banner::findOrFail($id);
        $bannerSub->title = $request->input('title');
        $bannerSub->status = ($request->input('status')=='1') ? '1' : '0';
        $bannerSub->url = $request->input('url');
        $bannerSub->sort = $request->input('sort');
        $bannerSub->text = $request->input('text');

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($bannerSub->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-SB'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(242, 162)->save();
            $bannerSub->image = 'media/other/'.$uploadname;
        }
        $bannerSub->save();

        if ($bannerSub->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Alt banner güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete banner.
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
                                      'alertMessage'=>'Alt banner silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
