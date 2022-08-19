<?php

namespace App\Services;

use App\Models\Province;

class ProvinceService
{
    public function getByCountryId(
        $country_id
    )
    {
        return Province::where('country_id', $country_id)->get()->map(function ($province) {
            return [
                'id' => $province->id,
                'name' => $province->name,
            ];
        });
    }
}
