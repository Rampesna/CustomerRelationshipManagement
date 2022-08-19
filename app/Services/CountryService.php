<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryService
{
    public function getAll()
    {
        return Country::all()->map(function ($country) {
            return [
                'id' => $country->id,
                'name' => $country->name,
            ];
        });
    }
}
