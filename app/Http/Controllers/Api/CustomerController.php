<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\GetByCompanyIdRequest;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->customerService->getByCompanyId(
            $request->company_id
        );
    }
}
