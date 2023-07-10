<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendOrderEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var array
     */
    private $order;

    /**
     * @var array
     */
    private $settings;

    /**
     * Send mail on new orders job.
     *
     * @param  array $order
     * @param  array $settings
     * @return void
     */
    public function __construct($order, $settings)
    {
        $this->order  = $order;
        $this->settings = $settings;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;
        $settings = $this->settings;

        Mail::send('emails.orderNew', array('name'    => $order->name,
                                            'surname' => $order->surname,
                                            'ref'     => $order->ref_number,
                                            'total'   => $order->total_amount,
                                            'title'   => $settings->title),
                    function ($message) use ($settings, $order) {
                        $message->from($settings->email_info, $settings->email_info_name);
                        $message->bcc($settings->email_admin, $settings->email_admin_name);
                        $message->to($order->email)->subject('Yeni Siparişiniz Alındı - '.date('d.m.Y'));
                    });
    }
}
