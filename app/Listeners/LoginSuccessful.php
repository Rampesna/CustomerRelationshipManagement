<?php

namespace App\Listeners;

use App\Helper\General;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        try {
            General::setMailConfig();
            if (($setting = Setting::find(1))->send_login_mail == 1) {
                Mail::to($setting->mail_recipient)->send(new LoginMail(auth()->user()));
            }
        } catch (\Exception $exception) {

        }
    }
}
