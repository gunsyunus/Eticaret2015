<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendOrderShipmentEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var array
     */
    private $order;

    /**
     * @var array
     */
    private $payment;

    /**
     * @var array
     */
    private $settings;
  
    /**
     * Order shipment delivery job.
     *
     * @param  array $order
     * @param  array $payment
     * @param  array $settings
     * @return void
     */
    public function __construct($order, $payment, $settings)
    {
        $this->order  = $order;
        $this->payment = $payment;
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
        $payment = $this->payment;
        $settings = $this->settings;
        
        Mail::send('emails.orderShipment', array('payment' => $payment->name,
                                                 'name'    => $order->name,
                                                 'surname' => $order->surname,
                                                 'ref'     => $order->ref_number,
                                                 'total'   => $order->total_amount,
                                                 'title'   => $settings->title),
                    function ($message) use ($settings, $order) {
                        $message->from($settings->email_info, $settings->email_info_name);
                        $message->to($order->email)->subject('Siparişiniz Kargoya Verildi - '.date('d.m.Y'));
                    });
    }
}
