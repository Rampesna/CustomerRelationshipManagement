<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewOfferEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewOfferEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_offer_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewOfferEmail([
                'subject' => 'Yeni Teklif Oluşturuldu',
                'offer' => $event->data['offer']
            ]));
        }
    }
}
