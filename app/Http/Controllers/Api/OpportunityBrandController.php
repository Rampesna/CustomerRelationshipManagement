<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OpportunityBrand\GetByCompanyIdRequest;
use App\Models\Definition;

class OpportunityBrandController extends Controller
{
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return Definition::where('company_id', $request->company_id)->where('name', 'Fırsat / Müşteri Çalıştığı Firmalar')->first()->definitions ?? [];
    }
}
