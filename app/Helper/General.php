<?php

namespace App\Helper;

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
            'code' => '',
            'ForexSelling' => '',
            'ForexBuying' => ''
        ];
    }

    public static function clearPhoneNumber($phoneNumber)
    {
        return str_replace('(', '', str_replace(')', '', str_replace('-', '', str_replace(' ', '', $phoneNumber))));
    }
}
