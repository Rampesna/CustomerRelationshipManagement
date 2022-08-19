<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OpportunitySector\GetByCompanyIdRequest;
use App\Models\Definition;

class OpportunitySectorController extends Controller
{
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return Definition::where('company_id', $request->company_id)->where('name', 'Fırsat / Müşteri Çalıştığı Sektörler')->first()->definitions ?? [];
    }
}
