<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewCustomerEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewCustomerEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_customer_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewCustomerEmail([
                'subject' => 'Yeni Müşteri Oluşturuldu',
                'customer' => $event->data['customer']
            ]));
        }
    }
}
