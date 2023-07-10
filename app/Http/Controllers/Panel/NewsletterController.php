<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\NewsletterCreateRequest;
use App\Http\Requests\NewsletterUpdateRequest;
use App\Models\Newsletter;
use Carbon\Carbon;
use Response;

class NewsletterController extends PanelController
{
    /**
     * List all subscriptions.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $newsletters = Newsletter::orderBy('id_subscriber', 'DESC')->paginate(25);
        return view('panel.module.newsletter.index', compact('newsletters'));
    }

    /**
     * Subscription form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.newsletter.new');
    }

    /**
     * Add subscriber.
     *
     * @param  NewsletterCreateRequest $request
     * @return Response
     */
    public function postAdd(NewsletterCreateRequest $request)
    {
        $subscriber = new Newsletter;
        $subscriber->email = $request->input('email');
        $subscriber->status = ($request->input('status')=='1') ? '1' : '0';
        $subscriber->ip_register_subscriber = $_SERVER['REMOTE_ADDR'];
        $subscriber->save();

        if ($subscriber->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Abone e-bülten listesine eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }
    
    /**
     * Update subscriber information.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $newsletters = Newsletter::findOrFail($id);
        return view('panel.module.newsletter.edit', compact('newsletters'));
    }

    /**
     * Update subscriber.
     *
     * @param  NewsletterUpdateRequest $request
     * @param  int                     $id
     * @return Response
     */
    public function postSave(NewsletterUpdateRequest $request, $id)
    {
        $subscriber = Newsletter::findOrFail($id);
        $subscriber->email = $request->input('email');
        $subscriber->status = ($request->input('status')=='1') ? '1' : '0';
        $subscriber->save();

        if ($subscriber->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Abone bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete subscriber.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $subscriber = Newsletter::findOrFail($id);
        $subscriber->delete();

        if (!$subscriber->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Abone e-bülten listesinden silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }

    /**
     * View subscriber information for export.
     *
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $active = Newsletter::where('status', '=', '1')->count();
        $passive = Newsletter::where('status', '=', '0')->count();
        $total = $active+$passive;
        $newsletters = (object) array('active'=>$active,
                                      'passive'=>$passive,
                                      'total'=>$total);
        return view('panel.module.newsletter.list', compact('newsletters'));
    }

    /**
     * Export subscriptions.
     *
     * @return Response
     */
    public function getExport()
    {
        $subscribers = Newsletter::where('status', '=', '1')->get();
        $content = view('panel.module.newsletter.export', compact('subscribers'));
        $fileName = 'E-Bulten-Liste-'.Carbon::now()->format('d-m-Y-H-i').'.txt';
        $headers = ['Content-Type'=>'text/plain','Content-Disposition'=>'attachment; filename='.$fileName.''];
        return Response::make($content, '200', $headers);
    }
}
