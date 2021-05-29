<?php


namespace App\Http\Controllers\Api;

class Crm extends Base
{
    public function __construct()
    {
        $this->baseUrl = env('CRM_API_BASE_URL', '');
    }

    // api/Mikro/getTicariProgramFinansalHareketler?Id=İ10103085&VeriTabani=MikroDB_V16_17

    public function getMusteriTicari($db)
    {
        $endpoint = "getMusteriTicari";
        $params = [
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getStoklarTicari($db)
    {
        $endpoint = "getStoklarTicari";
        $params = [
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }

    public function getTicariProgramSiparisHareketler($id, $db)
    {
        $endpoint = "getTicariProgramSiparisHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'] ?? [];
    }

    public function getMusteriTicariProgramBakiye($id, $db)
    {
        $endpoint = "getMusteriTicariProgramBakiye";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'][0]["Tutar"] ?? 0;
    }

    public function getTicariProgramFinansalHareketler($id, $db)
    {
        $endpoint = "getTicariProgramFinansalHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], [])['Response'] ?? [];
    }

    public function getTicariProgramFaturaHareketler($id, $db)
    {
        $endpoint = "getTicariProgramFaturaHareketler";
        $params = [
            'Id' => $id,
            'VeriTabani' => $db
        ];
        return $this->call($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', [], []);
    }
}
