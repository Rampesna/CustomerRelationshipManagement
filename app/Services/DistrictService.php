<?php

namespace App\Services;

use App\Models\District;

class DistrictService
{
    public function getByProvinceId(
        $province_id
    )
    {
        return District::where('province_id', $province_id)->get()->map(function ($district) {
            return [
                'id' => $district->id,
                'name' => $district->name,
            ];
        });
    }
}
