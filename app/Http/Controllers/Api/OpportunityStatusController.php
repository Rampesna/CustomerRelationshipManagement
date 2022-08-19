<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OpportunityStatus\GetByCompanyIdRequest;
use App\Models\Definition;

class OpportunityStatusController extends Controller
{
    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return Definition::where('company_id', $request->company_id)->where('name', 'Fırsat Durumları')->first()->definitions ?? [];
    }
}
