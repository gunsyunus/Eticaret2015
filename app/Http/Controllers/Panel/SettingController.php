<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\PanelController;
use App\Http\Requests\SettingGeneralRequest;
use App\Http\Requests\SettingFileRequest;
use App\Models\Setting;
use Image;
use File;
use URL;

class SettingController extends PanelController
{
    /**
     * Show general settings for e-commerce.
     *
     * @return \Illuminate\View\View
     */
    public function getGeneral()
    {
        $settings = Setting::findOrFail(1);
        return view('panel.module.setting.general', compact('settings'));
    }

    /**
     * Set shipping cost.
     *
     * @return \Illuminate\View\View
     */
    public function getCargo()
    {
        $settings = Setting::findOrFail(1);
        return view('panel.module.setting.cargo', compact('settings'));
    }

    /**
     * Update ordering with registered, no membership and fast order statuses.
     *
     * @return \Illuminate\View\View
     */
    public function getOrder()
    {
        $settings = Setting::findOrFail(1);
        return view('panel.module.setting.order', compact('settings'));
    }

    /**
     * General file upload.
     *
     * @return \Illuminate\View\View
     */
    public function getFile()
    {
        return view('panel.module.setting.file');
    }

    /**
     * Update general information.
     *
     * @param  SettingGeneralRequest $request
     * @return Response
     */
    public function postGeneralsave(SettingGeneralRequest $request)
    {
        $setting = Setting::findOrFail(1);
        $setting->title = $request->input('title');
        $setting->keyword = $request->input('keyword');
        $setting->description = $request->input('description');
        $setting->copyright = $request->input('copyright');
        $setting->welcome_msg = $request->input('welcome_msg');
        $setting->social_facebook_url = $request->input('social_facebook_url');
        $setting->social_twitter_url = $request->input('social_twitter_url');
        $setting->social_google_url = $request->input('social_google_url');
        $setting->social_linkedin_url = $request->input('social_linkedin_url');
        $setting->social_youtube_url = $request->input('social_youtube_url');
        $setting->social_instagram_url = $request->input('social_instagram_url');
        $setting->social_pinterest_url = $request->input('social_pinterest_url');
        $setting->tracing_body_after_code = $request->input('tracing_body_after_code');
        $setting->tracing_body_before_code = $request->input('tracing_body_before_code');
        $setting->tracing_head_code = $request->input('tracing_head_code');
        $setting->tracing_customer_code = $request->input('tracing_customer_code');
        $setting->tracing_order_code = $request->input('tracing_order_code');
        $setting->agreement_user_url = $request->input('agreement_user_url');
        $setting->agreement_cancel_url = $request->input('agreement_cancel_url');        
        $setting->agreement_order_title = $request->input('agreement_order_title');
        $setting->agreement_order_content = $request->input('agreement_order_content');
        $setting->bank_transfer_url = $request->input('bank_transfer_url');        
        $setting->email_admin = $request->input('email_admin');
        $setting->email_admin_name = $request->input('email_admin_name');
        $setting->email_info = $request->input('email_info');
        $setting->email_info_name = $request->input('email_info_name');
        $setting->ssl_status = ($request->input('ssl_status')=='1') ? '1' : '0';
        $setting->product_small_width = $request->input('product_small_width');
        $setting->product_small_height = $request->input('product_small_height');
        $setting->product_big_width = $request->input('product_big_width');
        $setting->product_big_height = $request->input('product_big_height');
        $setting->facebook_connect_status = $request->input('facebook_connect_status');
        $setting->save();

        if ($setting->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Bilgiler güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Update the shipping form.
     *
     * @param  Request $request
     * @return Response
     */
    public function postCargosave(Request $request)
    {
        $setting = Setting::findOrFail(1);
        $setting->cargo_total = $request->input('cargo_total');
        $setting->cargo_price = $request->input('cargo_price');
        $setting->cargo_text = $request->input('cargo_text');
        $setting->save();

        if ($setting->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kargo ücretlendirmesi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Update ordering settings.
     *
     * @param  Request $request [description]
     * @return Response
     */
    public function postOrdersave(Request $request)
    {
        $setting = Setting::findOrFail(1);
        $setting->order_method = $request->input('order_method');
        $setting->save();

        if ($setting->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Ödeme ayarları güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Upload files to the system.
     *
     * @param  SettingFileRequest $request
     * @return Response
     */
    public function postFilesave(SettingFileRequest $request)
    {
        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = 'R'.rand(1, 999999999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            $url = URL::to('media/other/'.$uploadname);
        }
        
        if ($url) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Dosya yüklendi. <br />
                                       <i class="fa fa-link"></i> <strong>LİNK :</strong> '.$url));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }
}
