<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\District\GetByProvinceIdRequest;
use App\Services\DistrictService;

class DistrictController extends Controller
{
    private $districtService;

    public function __construct()
    {
        $this->districtService = new DistrictService;
    }

    public function getByProvinceId(GetByProvinceIdRequest $request)
    {
        return $this->districtService->getByProvinceId($request->province_id);
    }
}
