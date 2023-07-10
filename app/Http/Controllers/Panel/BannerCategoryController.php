<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Category;
use Image;
use File;

class BannerCategoryController extends PanelController
{
    /**
     * Promotional banners to category pages.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banners = Banner::with('category')->where('type', '=', 'category')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.bannerCategory.index', compact('banners'));
    }

    /**
     * New banner form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        return view('panel.module.bannerCategory.new', compact('categories'));
    }

    /**
     * Add Banner
     *
     * @param  BannerRequest $request
     * @return int
     */
    public function postAdd(BannerRequest $request)
    {
        $banner = new Banner;
        $banner->title = $request->input('title');
        $banner->status = ($request->input('status')=='1') ? '1' : '0';
        $banner->url = $request->input('url');
        $banner->sort = $request->input('sort');
        $banner->text = $request->input('text');
        $banner->category_id = $request->input('category_id');
        $banner->type = 'category';

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-C'.rand(1, 99999).'.'.$extension;
            $upload->move('media/category/', $uploadname);
            Image::make('media/category/'.$uploadname)->resize(860, 320)->save();
            $banner->image = 'media/category/'.$uploadname;
        }

        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banner kategori eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit category banner form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banners = Banner::where('id_banner', '=', $id)->where('type', '=', 'category')->firstOrFail();
        return view('panel.module.bannerCategory.edit', compact('banners'));
    }

    /**
     * Update category banner.
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
        $banner->text = $request->input('text');

        $title = substr(str_slug($request->input('title')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($banner->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-C'.rand(1, 99999).'.'.$extension;
            $upload->move('media/category/', $uploadname);
            Image::make('media/category/'.$uploadname)->resize(860, 320)->save();
            $banner->image = 'media/category/'.$uploadname;
        }
        $banner->save();

        if ($banner->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banner kategori güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete category banner.
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
                                      'alertMessage'=>'Banner kategori silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
