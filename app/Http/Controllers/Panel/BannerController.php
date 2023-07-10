<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerRequest;
use App\Models\Design;
use App\Models\Banner;
use App\Models\BannerElement;
use File;

class BannerController extends PanelController
{
    /**
     * List the main banners.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banners = Banner::where('type', '=', 'home_slider')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.banner.index', compact('banners'));
    }

    /**
     * New banner.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.banner.new', compact('designs'));
    }

    /**
     * Add banner.
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
        $banner->delay = $request->input('delay');
        $banner->sort = $request->input('sort');
        $banner->type = 'home_slider';


        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/slide/', $uploadname);
            $banner->image = 'media/slide/'.$uploadname;
        }

        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banner eklendi.'));
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
        $banners = Banner::where('id_banner', '=', $id)->where('type', '=', 'home_slider')->firstOrFail();
        $elements = BannerElement::where('banner_id', '=', $id)->get();
        $types = ['Video' => 'video', 'Yazı' => 'text', 'Resim' => 'image'];
        $designs = Design::findOrFail(1);
        return view('panel.module.banner.edit', compact('banners', 'elements', 'types', 'designs'));
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
        $banner = Banner::findOrFail($id);
        $banner->title = $request->input('title');
        $banner->status = ($request->input('status')=='1') ? '1' : '0';
        $banner->url = $request->input('url');
        $banner->delay = $request->input('delay');
        $banner->sort = $request->input('sort');

        $elements = BannerElement::where('banner_id', '=', $banner->id_banner)->get();
        $elementsHtml = '';

        foreach ($elements as $key => $value) {
            if ($value['type']=='text') {
                $elementsActive = '<h4 class="ms-layer new-title1" style="color:'.$value['text_color'].'; 
                font-size:'.$value['text_size'].'px; 
                left:'.$value['xleft'].'px; 
                top:'.$value['xtop'].'px; 
                background-color: '.$value['bg_color'].';" 
                data-type="text" 
                data-duration="1500" 
                data-delay="'.$value['delay'].'" 
                data-ease="easeOutExpo" 
                data-effect="'.$value['effect'].'('.$value['effect_delay'].')">'.$value['text'].'</h4>';
                $elementsHtml = $elementsHtml.' '.$elementsActive;
            } elseif ($value['type']=='image') {
                $elementsActive = '<img src="/assets/css/slider/style/blank.gif" data-src="'.$value['image'].'" 
                alt="'.$value['name'].'" 
                style="left:'.$value['xleft'].'px; 
                top:'.$value['xtop'].'px;" 
                class="ms-layer" data-type="image" 
                data-effect="'.$value['effect'].'('.$value['effect_delay'].')" 
                data-delay="'.$value['delay'].'" data-duration="1500" data-ease="easeOutExpo" />';
                $elementsHtml = $elementsHtml.' '.$elementsActive;
            } elseif ($value['type']=='video') {
                $elementsActive = '<a href="'.$value['video_url'].'" data-type="video">'.$value['name'].'</a>';
                $elementsHtml = $elementsHtml.' '.$elementsActive;
            }
        }

        $banner->elements = $elementsHtml;

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($banner->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/slide/', $uploadname);
            $banner->image = 'media/slide/'.$uploadname;
        }
        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banner güncellendi.'));
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
                                      'alertMessage'=>'Banner silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
