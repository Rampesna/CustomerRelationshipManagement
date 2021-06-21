<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewSampleEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewSampleEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_sample_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewSampleEmail([
                'subject' => 'Yeni Numune Oluşturuldu',
                'sample' => $event->data['sample']
            ]));
        }
    }
}
