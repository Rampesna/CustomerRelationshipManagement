<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct()
    {
        $this->companyService = new CompanyService;
    }

    public function getAll()
    {
        return $this->companyService->getAll();
    }
}
