<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\DesignRequest;
use App\Models\Design;
use Image;
use File;

class DesignController extends PanelController
{
    /**
     * Set the web site logo.
     *
     * @return \Illuminate\View\View
     */
    public function getLogo()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.logo', compact('designs'));
    }

    /**
     * Upload the logo.
     *
     * @param  DesignRequest $request
     * @return Response
     */
    public function postLogosave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);

        if ($request->hasFile('logo')) {
            $upload = $request->file('logo');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = 'logo.'.$extension;
            $upload->move('media/logo/', $uploadname);
            $design->logo = 'media/logo/'.$uploadname;
            Image::make('media/logo/'.$uploadname)->resize(220, 70)->save();
            $design->save();
        }

        if ($design->save()) {
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
     * Edit the title and text on the page.
     *
     * @return \Illuminate\View\View
     */
    public function getText()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.text', compact('designs'));
    }

    /**
     * Update text information.
     *
     * @param  DesignRequest $request
     * @return Response
     */
    public function postTextsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);
        $design->home_text_1 = $request->input('home_text_1');
        $design->home_text_2 = $request->input('home_text_2');
        $design->home_text_3 = $request->input('home_text_3');
        $design->home_text_4 = $request->input('home_text_4');
        $design->home_text_5 = $request->input('home_text_5');
        $design->home_text_6 = $request->input('home_text_6');
        $design->home_text_7 = $request->input('home_text_7');
        $design->home_text_8 = $request->input('home_text_8');
        $design->home_text_9 = $request->input('home_text_9');
        $design->home_text_10 = $request->input('home_text_10');
        $design->home_text_11 = $request->input('home_text_11');
        $design->home_text_12 = $request->input('home_text_12');
        $design->home_text_13 = $request->input('home_text_13');
        $design->home_text_14 = $request->input('home_text_14');
        $design->home_tab_text_1 = $request->input('home_tab_text_1');
        $design->home_tab_text_2 = $request->input('home_tab_text_2');
        $design->home_tab_text_3 = $request->input('home_tab_text_3');
        $design->home_tab_text_4 = $request->input('home_tab_text_4');
        $design->home_tab_text_5 = $request->input('home_tab_text_5');
        $design->home_tab_text_6 = $request->input('home_tab_text_6');
        $design->newsletter_text = $request->input('newsletter_text');
        $design->product_title_text = $request->input('product_title_text');
        $design->outlet_title_text = $request->input('outlet_title_text');
        $design->similar_product_title = $request->input('similar_product_title');
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Metinler güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Edit footer information.
     *
     * @return \Illuminate\View\View
     */
    public function getFooter()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.footer', compact('designs'));
    }

    /**
     * Update footer information.
     *
     * @param  DesignRequest $request
     * @return Response
     */
    public function postFootersave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);

        if ($request->hasFile('footer_logo')) {
            $upload = $request->file('footer_logo');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = 'footer_logo.'.$extension;
            $upload->move('media/logo/', $uploadname);
            $design->footer_logo = 'media/logo/'.$uploadname;
            Image::make('media/logo/'.$uploadname)->resize(230, 104)->save();
        }

        $design->home_title_1 = $request->input('home_title_1');
        $design->footer_slogan = $request->input('footer_slogan');
        $design->footer_contact_1 = $request->input('footer_contact_1');
        $design->footer_contact_2 = $request->input('footer_contact_2');
        $design->footer_contact_3 = $request->input('footer_contact_3');
        $design->icon_status_1 = $request->input('icon_status_1');
        $design->icon_status_2 = $request->input('icon_status_2');
        $design->icon_status_3 = $request->input('icon_status_3');
        $design->icon_status_4 = $request->input('icon_status_4');
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Logo ve sloganlar güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Modules (section) can be enabled / disabled.
     *
     * @return Response
     */
    public function getSection()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.section', compact('designs'));
    }

    /**
     * Update section.
     *
     * @param  DesignRequest $request [description]
     * @return Response
     */
    public function postSectionsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);
        $design->outlet_section = ($request->input('outlet_section')=='1') ? '1' : '0';
        $design->similar_product_section = ($request->input('similar_product_section')=='1') ? '1' : '0';
        $design->newsletter_section = ($request->input('newsletter_section')=='1') ? '1' : '0';
        $design->home_section_1 = ($request->input('home_section_1')=='1') ? '1' : '0';
        $design->home_section_2 = ($request->input('home_section_2')=='1') ? '1' : '0';
        $design->home_section_3 = ($request->input('home_section_3')=='1') ? '1' : '0';
        $design->home_section_4 = ($request->input('home_section_4')=='1') ? '1' : '0';
        $design->home_section_5 = ($request->input('home_section_5')=='1') ? '1' : '0';
        $design->home_section_6 = ($request->input('home_section_6')=='1') ? '1' : '0';
        $design->home_section_7 = ($request->input('home_section_7')=='1') ? '1' : '0';
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Bloklar güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Home large advertising space.
     *
     * @return \Illuminate\View\View
     */
    public function getAdvert()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.advert', compact('designs'));
    }

    /**
     * Update home ad.
     *
     * @param  DesignRequest $request
     * @return Response
     */
    public function postAdvertsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);
      
        if ($request->hasFile('advert_image')) {
            $upload = $request->file('advert_image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = 'Home-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(1170, 149)->save();
            $design->advert_image = 'media/other/'.$uploadname;
        }

        $design->advert_link = $request->input('advert_link');
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Reklam alanı güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Product right ad slot.
     *
     * @return \Illuminate\View\View
     */
    public function getProduct()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.product', compact('designs'));
    }

    /**
     * Update ad.
     *
     * @param  DesignRequest $request.
     * @return Response
     */
    public function postProductsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);
        $design->product_advert_title = $request->input('product_advert_title');
        $design->product_advert_content = $request->input('product_advert_content');
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Reklam alanı güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * The user changes the design with the selected colors.
     *
     * @return Response
     */
    public function getColor()
    {
        $design = Design::findOrFail(1);
        $color = (object) json_decode($design->theme_colors, true);
        return view('panel.module.design.color', compact('color'));
    }

    /**
     * Update the design colors.
     *
     * @return Response
     */
    public function postColorsave(DesignRequest $request)
    {
        $main = $request->input('main');
        $menu = $request->input('menu');
        $menufont = $request->input('menufont');
        $newsletter = $request->input('newsletter');
        $footer = $request->input('footer');
        $socialfooter = $request->input('socialfooter');
        $subfooter = $request->input('subfooter');
        $footerfont = $request->input('footerfont');
        $productborder = $request->input('productborder');

        if ($productborder) {
            $productborder = 'border:1px solid '.$productborder.'; padding-bottom: 10px;';            
        }

        $delete = File::delete('./assets/css/style.min.css');
        $copy = File::copy('./assets/css/default.min.css', './assets/css/style.min.css');
        $css = File::get('./assets/css/style.min.css');
        $oldColor = array('MAINCOLOR',
                          'MENUCOLOR',
                          'NEWSLETTERCOLOR',
                          'FOOTERCOLOR',
                          'SOCIALSECTIONCOLOR',
                          'SUBFOOCOLOR',
                          'MENUFONTCOLOR',
                          'FOOTERFONTCOLOR',
                          'border:PRODUCTBORDERCOLOR');
        $newColor = array($main,
                          $menu,
                          $newsletter,
                          $footer,
                          $socialfooter,
                          $subfooter,
                          $menufont,
                          $footerfont,
                          $productborder);
        $new = str_replace($oldColor, $newColor, $css);
        $change = File::put('./assets/css/style.min.css', $new);

        $design = Design::findOrFail(1);
        $colors = collect(['main' => $main,
                           'menu' => $menu,
                           'newsletter' => $newsletter,
                           'footer' => $footer,
                           'socialfooter' => $socialfooter,
                           'subfooter' => $subfooter,
                           'menufont' => $menufont,
                           'footerfont' => $footerfont,
                           'productborder' => $productborder]);
        $design->theme_colors = $colors->toJson();
        $design->save();

        return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                  'alertClass'=>'success',
                                  'alertMessage'=>'Yeni tasarım oluşturuldu.'));
    }
 
    /**
     * Favicon insertion form.
     *
     * @return \Illuminate\View\View
     */
    public function getFavicon()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.favicon', compact('designs'));
    }

    /**
     * Upload the favicon.
     *
     * @param  DesignRequest $request [description]
     * @return Response
     */
    public function postFaviconsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);

        if ($request->hasFile('favicon_logo')) {
            $upload = $request->file('favicon_logo');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = 'favicon.'.$extension;
            $upload->move('media/logo/', $uploadname);
            $design->favicon_logo = 'media/logo/'.$uploadname;
            Image::make('media/logo/'.$uploadname)->resize(16, 16)->save();
            $design->save();
        }

        if ($design->save()) {
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
     * Design settings form.
     *
     * @return \Illuminate\View\View
     */
    public function getSetting()
    {
        $designs = Design::findOrFail(1);
        return view('panel.module.design.setting', compact('designs'));
    }

    /**
     * Update design settings.
     *
     * @param  DesignRequest $request
     * @return Response
     */
    public function postSettingsave(DesignRequest $request)
    {
        $design = Design::findOrFail(1);
        $design->banner_width = $request->input('banner_width');
        $design->banner_height = $request->input('banner_height');
        $design->banner_scene_width = $request->input('banner_scene_width');
        $design->banner_effect_type = $request->input('banner_effect_type');
        $design->banner_buttons = $request->input('banner_buttons');
        $design->banner_arrows = $request->input('banner_arrows');
        $design->banner_timebar = $request->input('banner_timebar');
        $design->multiple_product_image = $request->input('multiple_product_image');
        $design->save();

        if ($design->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Tasarım ayarları güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }
}
