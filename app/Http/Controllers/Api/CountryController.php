<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CountryService;

class CountryController extends Controller
{
    private $countryService;

    public function __construct()
    {
        $this->countryService = new CountryService;
    }

    public function getAll()
    {
        return $this->countryService->getAll();
    }
}
