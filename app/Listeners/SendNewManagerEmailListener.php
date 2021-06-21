<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewManagerEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewManagerEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_manager_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewManagerEmail([
                'subject' => 'Yeni Yetkili Oluşturuldu',
                'manager' => $event->data['manager']
            ]));
        }
    }
}
