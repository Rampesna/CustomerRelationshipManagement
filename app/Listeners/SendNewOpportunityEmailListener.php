<?php

namespace App\Listeners;

use App\Helper\General;
use App\Mail\NewOpportunityEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewOpportunityEmailListener
{
    public function handle($event)
    {
        if ($event->data['setting']->send_opportunity_email === 1) {
            General::setMailConfig($event->data['setting']->company_id);
            Mail::to($event->data['setting']->mail_recipient)->send(new NewOpportunityEmail([
                'subject' => 'Yeni Fırsat Oluşturuldu',
                'opportunity' => $event->data['opportunity']
            ]));
        }
    }
}
