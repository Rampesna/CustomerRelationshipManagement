<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewActivityEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewActivityEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_activity_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewActivityEmail([
                'subject' => 'Yeni Aktivite Oluşturuldu',
                'activity' => $event->data['activity']
            ]));
        }
    }
}
