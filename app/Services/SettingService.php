<?php

namespace App\Services;

use App\Models\Manager;
use App\Models\Setting;
use App\Models\Target;
use Illuminate\Http\Request;

class SettingService
{
    public $setting;

    /**
     * @return Setting
     */
    public function getSetting(): Setting
    {
        return $this->setting;
    }

    /**
     * @param Setting $setting
     */
    public function setSetting(Setting $setting): void
    {
        $this->setting = $setting;
    }

    public function updateMailSettings(Request $request)
    {
        $this->setting->mail_host = $request->mail_host;
        $this->setting->mail_port = $request->mail_port;
        $this->setting->mail_encryption = $request->mail_encryption;
        $this->setting->mail_username = $request->mail_username;
        $this->setting->mail_password = $request->mail_password;
        $this->setting->mail_from_email = $request->mail_from_email;
        $this->setting->mail_from_name = $request->mail_from_name;
        $this->setting->mail_recipient = $request->mail_recipient;
        $this->setting->save();
    }
}
