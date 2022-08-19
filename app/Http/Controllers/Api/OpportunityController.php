<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Opportunity\CreateRequest;
use App\Models\Opportunity;
use App\Services\OpportunityService;

class OpportunityController extends Controller
{
    public function create(CreateRequest $request)
    {
        $opportunityService = new OpportunityService;
        $opportunityService->setOpportunity(new Opportunity);
        return $opportunityService->saveWithParams(
            null,
            $request->user_id,
            $request->company_id,
            $request->customer_id,
            $request->name,
            $request->email,
            $request->identification_number,
            $request->phone_number,
            $request->manager_name,
            $request->manager_email,
            $request->manager_phone_number,
            $request->website,
            $request->description,
            $request->date,
            $request->price,
            $request->currency,
            $request->priority_id,
            $request->access_type_id,
            $request->domestic,
            $request->country_id,
            $request->province_id,
            $request->district_id,
            $request->foundation_date,
            $request->estimated_result,
            $request->estimated_result_type_id,
            $request->capacity,
            $request->capacity_type_id,
            $request->status_id,
            $request->calendar,
            $request->user()->id,
            $request->user()->id,
            $request->brands,
            $request->sectors
        );
    }
}
