<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Province\GetByCountryIdRequest;
use App\Services\ProvinceService;

class ProvinceController extends Controller
{
    private $provinceService;

    public function __construct()
    {
        $this->provinceService = new ProvinceService;
    }

    public function getByCountryId(GetByCountryIdRequest $request)
    {
        return $this->provinceService->getByCountryId($request->country_id);
    }
}
