<?php

namespace App\Services;

use App\Models\Opportunity;
use App\Models\OpportunityActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerService
{
    private $customer;

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }


    public function save(Request $request)
    {
        $this->customer->company_id = $request->company_id;
        $this->customer->title = $request->title;
        $this->customer->tax_number = $request->tax_number;
        $this->customer->tax_office = $request->tax_office;
        $this->customer->email = $request->email;
        $this->customer->phone_number = $request->phone_number;
        $this->customer->website = $request->website;
        $this->customer->country_id = $request->country_id;
        $this->customer->province_id = $request->province_id;
        $this->customer->district_id = $request->district_id;
        $this->customer->foundation_date = $request->foundation_date;
        $this->customer->class_id = $request->class_id;
        $this->customer->type_id = $request->type_id;
        $this->customer->reference_id = $request->reference_id;
        $this->customer->save();

        return $this->customer;
    }
}
