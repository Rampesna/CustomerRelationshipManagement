<?php


namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;

abstract class Base
{

    public $baseUrl;
    public $token;

    protected function call($url, $method, $headers = [], $params = [])
    {
        return Http::withHeaders($headers)->$method($url, $params);
    }
}
