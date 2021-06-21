<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewPriceListEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewPriceListEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_pricelist_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewPriceListEmail([
                'subject' => 'Yeni Fiyat Listesi Oluşturuldu',
                'priceList' => $event->data['priceList']
            ]));
        }
    }
}
