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

    public function updateSystemSettings(Request $request)
    {
        $this->setting->send_opportunity_email = $request->send_opportunity_email;
        $this->setting->send_activity_email = $request->send_activity_email;
        $this->setting->send_customer_email = $request->send_customer_email;
        $this->setting->send_manager_email = $request->send_manager_email;
        $this->setting->send_sample_email = $request->send_sample_email;
        $this->setting->send_offer_email = $request->send_offer_email;
        $this->setting->send_stock_email = $request->send_stock_email;
        $this->setting->send_pricelist_email = $request->send_pricelist_email;
        $this->setting->save();
    }

    public function checkMailSendingSetting($setting)
    {
        return $this->setting->$setting;
    }
}
