<?php


namespace App\Http\Controllers\Api;

class Crm extends Base
{
    public function __construct()
    {
        $this->baseUrl = env('CRM_API_BASE_URL', '');
    }

    // api/Mikro/getTicariProgramFinansalHareketler?Id=İ10103085&VeriTabani=MikroDB_V16_17

    public function getMusteriTicari($db = 'MikroDB_V16_17')
    {
        $endpoint = "getMusteriTicari";
        $params = [
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getStoklarTicari($db = 'MikroDB_V16_17')
    {
        $endpoint = "getStoklarTicari";
        $params = [
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getTicariProgramSiparisHareketler($id, $db = 'MikroDB_V16_17')
    {
        $endpoint = "getTicariProgramSiparisHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'] ?? [];
    }

    public function getMusteriTicariProgramBakiye($id, $db = 'MikroDB_V16_17')
    {
        $endpoint = "getMusteriTicariProgramBakiye";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'][0]["Tutar"] ?? 0;
    }

    public function getTicariProgramFinansalHareketler($id, $db = 'MikroDB_V16_17')
    {
        $endpoint = "getTicariProgramFinansalHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'] ?? [];
    }

    public function getTicariProgramFaturaHareketler($id, $db = 'MikroDB_V16_17')
    {
        $endpoint = "getTicariProgramFaturaHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db = 'MikroDB_V16_17'
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getUlkeListesi($db = 'MikroDB_V16')
    {
        $endpoint = "getUlkeListesi";
        $params = [
            'VeriTabani' => $db ?? 'MikroDB_V16'
        ];

        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getSehirListesi($db = 'MikroDB_V16')
    {
        $endpoint = "getSehirListesi";
        $params = [
            'VeriTabani' => $db ?? 'MikroDB_V16'
        ];

        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getIlceListesi($db = 'MikroDB_V16')
    {
        $endpoint = "getIlceListesi";
        $params = [
            'VeriTabani' => $db ?? 'MikroDB_V16'
        ];

        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }
}
