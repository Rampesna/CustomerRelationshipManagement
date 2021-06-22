<?php

namespace App\Services;

use App\Events\SendEmailEvent;
use App\Models\Opportunity;
use App\Models\OpportunityActivity;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OpportunityService
{
    private $opportunity;

    /**
     * @return Opportunity
     */
    public function getOpportunity(): Opportunity
    {
        return $this->opportunity;
    }

    /**
     * @param Opportunity $opportunity
     */
    public function setOpportunity(Opportunity $opportunity): void
    {
        $this->opportunity = $opportunity;
    }

    public function save(Request $request)
    {
        $this->opportunity->user_id = $request->user_id;
        $this->opportunity->company_id = $request->company_id;
        $this->opportunity->customer_id = $request->customer_id;
        $this->opportunity->name = $request->name;
        $this->opportunity->email = $request->email;
        $this->opportunity->phone_number = $request->phone_number;
        $this->opportunity->manager_name = $request->manager_name;
        $this->opportunity->manager_email = $request->manager_email;
        $this->opportunity->manager_phone_number = $request->manager_phone_number;
        $this->opportunity->website = $request->website;
        $this->opportunity->description = $request->description;
        $this->opportunity->date = $request->date;
        $this->opportunity->price = $request->price;
        $this->opportunity->currency = $request->currency;
        $this->opportunity->priority_id = $request->priority_id;
        $this->opportunity->access_type_id = $request->access_type_id;
        $this->opportunity->domestic = $request->domestic;
        $this->opportunity->country_id = $request->country_id;
        $this->opportunity->province_id = $request->province_id;
        $this->opportunity->district_id = $request->district_id;
        $this->opportunity->foundation_date = $request->foundation_date;
        $this->opportunity->estimated_result = $request->estimated_result;
        $this->opportunity->estimated_result_type_id = $request->estimated_result_type_id;
        $this->opportunity->capacity = $request->capacity;
        $this->opportunity->capacity_type_id = $request->capacity_type_id;
        $this->opportunity->status_id = $request->status_id;
        $this->opportunity->calendar = $request->calendar;
        $this->opportunity->created_by = $request->id ? $this->opportunity->created_by : $request->auth_user_id;
        $this->opportunity->last_updated_by = $request->auth_user_id;
        $this->opportunity->save();

        $opportunityActivityService = new OpportunityActivityService;
        $opportunityActivityService->setOpportunityActivity(new OpportunityActivity);
        $opportunityActivityService->save($request->auth_user_id, $this->opportunity->id, $request->status_id);

        if (!$request->id) {
            event(new SendEmailEvent([
                'setting' => Setting::where('company_id', $this->opportunity->company_id)->first(),
                'opportunity' => $this->opportunity
            ]));
        }

        return $this->opportunity;
    }
}
