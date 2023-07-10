<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\NewsletterCreateRequest;
use App\Http\Controllers\ProcessController;
use App\Models\County;
use App\Models\Newsletter;
use Response;

class ServiceController extends ProcessController
{
    /**
     * Show counties in order and address screens when city are selected.
     *
     * @param  int $id
     * @return Response
     */
    public function county($id)
    {
        $counties = County::where('city_id', '=', $id)->orderBy('name', 'ASC')->get(['id_county','name']);
        return Response::json($counties);
    }

    /**
     * Adds a new subscriber to the newsletter.
     *
     * @param  NewsletterCreateRequest $request
     * @return Response
     */
    public function newsletter(NewsletterCreateRequest $request)
    {
        $subscriber = new Newsletter;
        $subscriber->email = $request->input('email');
        $subscriber->ip_register_subscriber = $_SERVER['REMOTE_ADDR'];
        $subscriber->status = 1;
        $subscriber->save();

        $response = [
            'message' => 'E-Posta adresiniz kayıt edildi, teşekkür ederiz.'
        ];

        return Response::json($response);
    }
}
