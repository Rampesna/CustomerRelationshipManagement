<?php

namespace App\Helper;

use App\Models\Setting;

class General
{
    public static function getCurrency($currencyCode)
    {
        $baseUrl = "https://www.tcmb.gov.tr/kurlar/today.xml";
        header("Content-Type: text/html; charset=utf8");
        $xml = file_get_contents($baseUrl);
        $currencies = simplexml_load_string($xml);

        foreach ($currencies as $currency) {
            if ($currency['Kod'] == $currencyCode) {
                return [
                    'code' => $currency['Kod'],
                    'ForexSelling' => $currency->ForexSelling->__toString(),
                    'ForexBuying' => $currency->ForexBuying->__toString()
                ];
            }
        }

        return [
            'code' => 'TRY',
            'ForexSelling' => 1,
            'ForexBuying' => 1
        ];
    }

    public static function clearPhoneNumber($phoneNumber)
    {
        return str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $phoneNumber))));
    }

    public static function setMailConfig($companyId)
    {
        $settings = Setting::where('company_id', $companyId)->first();
        $mailConfig = [
            'transport' => 'smtp',
            'host' => $settings->mail_host,
            'port' => $settings->mail_port,
            'encryption' => $settings->mail_encryption,
            'username' => $settings->mail_username,
            'password' => $settings->mail_password,
            'from' => [
                'address' => $settings->mail_from_email,
                'name' => $settings->mail_from_name
            ],
            'timeout' => null
        ];

        config(['mail.mailers.smtp' => $mailConfig]);
    }
}
