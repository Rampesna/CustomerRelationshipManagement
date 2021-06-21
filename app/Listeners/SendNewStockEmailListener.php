<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewStockEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewStockEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_stock_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewStockEmail([
                'subject' => 'Yeni Stok Oluşturuldu',
                'stock' => $event->data['stock']
            ]));
        }
    }
}
